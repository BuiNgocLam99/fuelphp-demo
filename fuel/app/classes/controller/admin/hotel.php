<?php

class Controller_Admin_Hotel extends Controller_Template
{
    const EXCLUDE_IMAGES = ['resort', 'inn', 'guesthouse', 'glamping', 'comingsoon', 'city', 'capsule', 'business'];

    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        Controller_Auth::checkAdmin();

        $this->template->title = 'Hotel';
    }

    public function action_index()
    {
        $filter = Input::get('filter');
        $prefectureId = Input::get('prefecture');
        $search = trim(Input::get('search'));

        $conditions = [];

        if ($prefectureId) {
            $conditions['prefecture_id'] = $prefectureId;
        }
        if ($filter) {
            $conditions['filter'] = $filter;
        }

        $data = [];

        $paginationUrl = Uri::create('admin/hotel');
        $queryParams = [];

        if ($filter) {
            $queryParams['filter'] = $filter;
        }

        if ($prefectureId) {
            $queryParams['prefecture'] = $prefectureId;
        }

        if ($search) {
            $queryParams['search'] = $search;
        }

        if (!empty($queryParams)) {
            $paginationUrl .= '?' . http_build_query($queryParams);
        }

        $config = array(
            'pagination_url' => $paginationUrl,
            'total_items'    => $this->getTotalItems($conditions, $search),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );

        $pagination = Pagination::forge('pagination', $config);

        $query = Model_Hotel::query()
            ->related('prefecture')
            ->related('booking_list', ['status' => 2])
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page);

        if (isset($conditions['prefecture_id'])) {
            $query->where('prefecture_id', '=', $conditions['prefecture_id']);
        }

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($filter === 'oldest') {
            $query->order_by('id', 'desc');
        } else {
            $query->order_by('id', 'asc');
        }

        $data['hotels'] = $query->get();
        $data['prefectures'] = Model_Prefecture::find('all');
        $data['pagination'] = $pagination;
        $data['search'] = $search;

        $this->template->content = View::forge('admin/hotel/index', $data);
    }

    private function getTotalItems($conditions = [], $search = null)
    {
        $query = Model_Hotel::query();

        if (isset($conditions['prefecture_id'])) {
            $query->where('prefecture_id', '=', $conditions['prefecture_id']);
        }

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->count();
    }

    public function action_hotels($id)
    {
        $prefecture = Model_Prefecture::find($id, ['related' => ['hotels']]);

        if (!$prefecture) {
            return Response::forge(json_encode(['error' => 'Prefecture not found']), 404);
        }

        $hotels = array_map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
            ];
        }, $prefecture->hotels);

        return Response::forge(json_encode(['hotels' => $hotels]), 200)
            ->set_header('Content-Type', 'application/json');
    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add_field('name', 'Hotel Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('prefecture_id', 'Prefecture', 'required|is_numeric');

            $errors = [];

            $file = Input::file('image');

            if ($file['name']) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    $errors['image'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.';
                } else {
                    $upload_dir = DOCROOT . 'assets/img/hotel/';
                    $filename = uniqid() . '_' . $file['name'];
                
                    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                        $file_path = '/assets/img/hotel/' . $filename;
                    } else {
                        $errors['image'] = "Can't upload image!";
                    }
                }
            } else {
                $errors['image'] = 'Hotel photo cannot be left blank';
            }

            if ($val->run() && empty($errors)) {
                $hotel = Model_Hotel::forge();
                $hotel->name = Input::post('name');
                $hotel->prefecture_id = Input::post('prefecture_id');
                $hotel->file_path = $file_path;
                $hotel->status = 1;
                $hotel->created_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                
                if ($hotel->save()) {
                    Session::set_flash('success', 'Hotel created successfully! <br><a href="/admin/hotel">Hotel list</a>');
                } else {
                    Session::set_flash('error', 'There was a problem creating the hotel.');
                }
            } else {
                $val_errors = $val->error();
                foreach ($errors as $field => $message) {
                    $val_errors[$field] = $message;
                }

                $this->template->set_global('errors', $val_errors);
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');

        $this->template->content = View::forge('admin/hotel/create', $data);
    }

    public function action_edit($id)
    {
        if (is_null($id) || !($hotel = Model_Hotel::find($id))) {
            Session::set_flash('error', 'Hotel not found.');
            Response::redirect('/admin/hotel');
        }

        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add_field('name', 'Hotel Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('prefecture_id', 'Prefecture', 'required|is_numeric');
            $val->add_field('status', 'Status', 'required|min_length[1]|max_length[1]');

            $errors = [];

            $file = Input::file('image');

            if ($file['name']) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    $errors['image'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.';
                } else {
                    $upload_dir = DOCROOT . 'assets/img/hotel/';
                    $filename = uniqid() . '_' . $file['name'];
                
                    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                        $file_path = 'hotel/' . $filename;
                    } else {
                        $errors['image'] = "Can't upload image!";
                    }
                }
            } else {
                $file_path = $hotel->file_path;
            }

            if (!in_array(Input::post('status'), [0, 1])) {
                $errors['status'] = 'Status must be either Active or Inactive.';
            }

            if ($val->run() && empty($errors)) {
                $hotel->name = Input::post('name');
                $hotel->prefecture_id = Input::post('prefecture_id');
                $hotel->file_path = $file_path;
                $hotel->status = Input::post('status');
                $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                
                if ($hotel->save()) {
                    Session::set_flash('success', 'Hotel updated successfully! <br><a href="/admin/hotel">Hotel list</a>');
                } else {
                    Session::set_flash('error', 'There was a problem updating the hotel.');
                }
            } else {
                $val_errors = $val->error();
                foreach ($errors as $field => $message) {
                    $val_errors[$field] = $message;
                }

                $this->template->set_global('errors', $val_errors);
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');
        $data['hotel'] = $hotel;

        $this->template->content = View::forge('admin/hotel/edit', $data);
    }

    public function action_status($id = null)
    {
        if (is_null($id) || !($hotel = Model_Hotel::find($id))) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => 'Hotel not found.',
            ]), 404, ['Content-Type' => 'application/json']);
        }

        try {
            $hotel->status = $hotel->status == 1 ? 0 : 1;
            $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
            $hotel->save();

            return Response::forge(json_encode([
                'status' => 'success',
                'message' => 'Change status successfully.',
            ]), 200, ['Content-Type' => 'application/json']);
        } catch (Exception $e) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => 'An error occurred while change status.',
            ]), 500, ['Content-Type' => 'application/json']);
        }
    }
}