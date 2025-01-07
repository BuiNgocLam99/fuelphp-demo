<?php

class Controller_Admin_Hotel extends Controller_Template
{
    const EXCLUDE_IMAGES = ['resort', 'inn', 'guesthouse', 'glamping', 'comingsoon', 'city', 'capsule', 'business'];

    public $template = 'admin/template';

    public function action_index()
    {
        $filter = Input::get('filter');
        
        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/hotel'),
            'total_items'    => Model_Hotel::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );
        
        $pagination = Pagination::forge('pagination', $config);

        $data['hotels'] = Model_Hotel::query()
            ->related('prefecture')
            ->related('booking_list')
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page);

        if ($filter && $filter === 'oldest') {
            $data['hotels']->order_by('id', 'desc');
        }

        $data['hotels'] = $data['hotels']->get();

        $data['pagination'] = $pagination;

        $this->template->title = 'Hotels';
        $this->template->content = View::forge('admin/hotel/index', $data);
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
            $file = Input::file('image');

            $isImgError = false;

            if ($file['name']) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    $isImgError = true;
                } else {
                    $upload_dir = DOCROOT . 'assets/img/hotel/';
                    $filename = uniqid() . '_' . $file['name'];
                
                    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                        $file_path = '/assets/img/hotel/' . $filename;
                    } else {
                        $isImgError = true;
                        Session::set_flash('error', 'Failed to upload image.');
                    }
                }
            } else {
                $isImgError = true;
            }

            $val = Validation::forge();
            $val->add_field('name', 'Hotel Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('prefecture_id', 'Prefecture', 'required|is_numeric');

            if ($val->run() && !$isImgError) {
                $hotel = Model_Hotel::forge();
                $hotel->name = Input::post('name');
                $hotel->prefecture_id = Input::post('prefecture_id');
                $hotel->file_path = $file_path;
                $hotel->created_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                
                if ($hotel->save()) {
                    Session::set_flash('success', 'Hotel created successfully! <br><a href="/admin/hotel">Hotel list</a>');
                } else {
                    Session::set_flash('error', 'There was a problem creating the hotel.');
                }
            } else {
                $errors = $val->error();

                if ($isImgError) {
                    $errors['image'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.';
                }
                
                $this->template->set_global('errors', $errors);
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');

        $this->template->content = View::forge('admin/hotel/create', $data);
    }

    public function action_edit($id)
    {
        $hotel = Model_Hotel::find($id);

        if (!$hotel) {
            Session::set_flash('error', 'Hotel not found.');
            Response::redirect('/admin/hotel');
        }

        if (Input::method() == 'POST') {
            $file = Input::file('image');
            $isImgError = false;

            if ($file['name']) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    $isImgError = true;
                } else {
                    $upload_dir = DOCROOT . 'assets/img/hotel/';
                    $filename = uniqid() . '_' . $file['name'];
                
                    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                        $file_path = 'hotel/' . $filename;
                    } else {
                        $isImgError = true;
                        Session::set_flash('error', 'Failed to upload image.');
                    }
                }
            } else {
                $file_path = $hotel->file_path;
            }

            $val = Validation::forge();
            $val->add_field('name', 'Hotel Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('prefecture_id', 'Prefecture', 'required|is_numeric');

            if ($val->run() && !$isImgError) {
                $hotel->name = Input::post('name');
                $hotel->prefecture_id = Input::post('prefecture_id');
                $hotel->file_path = $file_path;
                $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                
                if ($hotel->save()) {
                    Session::set_flash('success', 'Hotel updated successfully! <br><a href="/admin/hotel">Hotel list</a>');
                    Response::redirect('/admin/hotel');
                } else {
                    Session::set_flash('error', 'There was a problem updating the hotel.');
                }
            } else {
                $errors = $val->error();

                if ($isImgError) {
                    $errors['image'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.';
                }
                
                $this->template->set_global('errors', $errors);
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');
        $data['hotel'] = $hotel;

        $this->template->content = View::forge('admin/hotel/edit', $data);
    }
}