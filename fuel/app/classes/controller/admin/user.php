<?php

use Fuel\Core\Debug;

class Controller_Admin_User extends Controller_Template
{
    const GROUP_IDS = ['client' => 50, 'admin' => 100];
    
    public $template = 'admin/template';

    public function action_index()
    {
        $filter = Input::get('filter');

        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/user'),
            'total_items'    => Model_User::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );
        
        $pagination = Pagination::forge('pagination', $config);

        $query = Model_User::query()
            ->related('booking_list')
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page);

        if ($filter && $filter === 'oldest') {
            $query->order_by('id', 'desc');
        }

        $data['users'] = $query->get();

        $data['pagination'] = $pagination;

        $this->template->content = View::forge('admin/user/index', $data);
    }

    public function action_create()
    {
        if (Input::method() == 'POST') {

            $username = Input::post('username');
            $email = Input::post('email');
            $password = Input::post('password');
            $group_id = Input::post('group_id');

            $val = Validation::forge();
            $val->add_field('username', 'Username', 'required|min_length[2]|max_length[255]');
            $val->add_field('email', 'Email', 'required|valid_email');
            $val->add_field('password', 'Password', 'required|min_length[6]');
            $val->add_field('group_id', 'Group', 'required');

            $errors = [];

            if (!in_array($group_id, array_values(self::GROUP_IDS))) {
                $errors['group_id'] = 'Group ID is invalid.';
            }

            $existing_user = Model_User::query()->where('email', $email)->get_one();
            if ($existing_user) {
                $errors['email'] = 'Email is already in use.';
            }

            if ($val->run() && empty($errors)) {
                $hashed_password = Auth::hash_password($password);

                $user = Model_User::forge();
                $user->username = $username;
                $user->email = $email;
                $user->password = $hashed_password;
                $user->group_id = $group_id;
                $user->created_at = \Fuel\Core\Date::forge()->get_timestamp();
                $user->updated_at = \Fuel\Core\Date::forge()->get_timestamp();

                if ($user->save()) {
                    $user->user_id = $user->id;
                    $user->save();

                    Session::set_flash('success', 'User created successfully! <br><a href="/admin/user">User list</a>');
                } else {
                    Session::set_flash('error', 'An error occurred while saving the user.');
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
        $data['group_ids'] = self::GROUP_IDS;

        $this->template->content = View::forge('admin/user/create', $data);
    }

    public function action_edit($id = null)
    {
        if (is_null($id) || !($user = Model_User::find($id))) {
            Session::set_flash('error', 'User not found.');
            Response::redirect('/admin/user');
        }

        if (Input::method() == 'POST') {

            $username = Input::post('username');
            $email = Input::post('email');
            $password = Input::post('password');
            $group_id = Input::post('group_id');

            $val = Validation::forge();
            $val->add_field('username', 'Username', 'required|min_length[2]|max_length[255]');
            $val->add_field('email', 'Email', 'required|valid_email');
            $val->add_field('password', 'Password', 'min_length[6]');
            $val->add_field('group_id', 'Group', 'required');

            $errors = [];

            if (!in_array($group_id, array_values(self::GROUP_IDS))) {
                $errors['group_id'] = 'Group ID is invalid.';
            }

            $existing_user = Model_User::query()
                ->where('email', $email)
                ->where('id', '!=', $user->id)
                ->get_one();
            if ($existing_user) {
                $errors['email'] = 'Email is already in use.';
            }

            if ($val->run() && empty($errors)) {
                $user->username = $username;
                $user->email = $email;
                $user->group_id = $group_id;

                if (!empty($password)) {
                    $user->password = Auth::hash_password($password);
                }

                $user->updated_at = \Fuel\Core\Date::forge()->get_timestamp();

                if ($user->save()) {
                    Session::set_flash('success', 'User updated successfully! <br><a href="/admin/user">User list</a>');
                } else {
                    Session::set_flash('error', 'An error occurred while updating the user.');
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
        $data['group_ids'] = self::GROUP_IDS;
        $data['user'] = $user;

        $this->template->content = View::forge('admin/user/edit', $data);
    }

}