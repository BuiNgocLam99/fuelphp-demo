<?php

class Controller_Auth extends Controller_Template
{
    public $template = 'auth/template';

    public function action_register()
    {
        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add_field('username', 'Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('email', 'Email', 'required|valid_email');
            $val->add_field('password', 'Password', 'required|min_length[6]');
            
            if ($val->run()) {
                return 'if';
                echo Input::post('name');
                try {
                    Auth::create_user(
                        Input::post('name'),
                        Input::post('password'),
                        Input::post('email'),
                        0
                    );
    
                    return Response::forge(json_encode([
                        'status' => 'success',
                        'message' => 'Registration successful.',
                    ]), 200);
                } catch (SimpleUserUpdateException $e) {
                    return Response::forge(json_encode([
                        'status' => 'error',
                        'message' => 'Username or email already exists.',
                    ]), 400);
                }
            } else {
                return 'else';
                return Response::forge(json_encode([
                    'status' => 'error',
                    'message' => $val->error(),
                ]), 422);
            }
        }

        $this->template->title = 'Register';
        $this->template->content = View::forge('auth/register');
    }

    // Hiển thị form đăng nhập
    public function action_login()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            Response::redirect('dashboard');
        }

        // Xử lý khi form được gửi
        if (Input::method() == 'POST') {
            $auth = Auth::instance();
            if ($auth->login(Input::post('username'), Input::post('password'))) {
                // Đăng nhập thành công
                if (Input::post('remember', false)) {
                    Auth::remember_me();
                } else {
                    Auth::dont_remember_me();
                }
                Response::redirect('dashboard');
            } else {
                // Đăng nhập thất bại
                Session::set_flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
            }
        }

        // Hiển thị view đăng nhập
        $this->template->title = 'Đăng nhập';
        $this->template->content = View::forge('auth/login');
    }

    // Đăng xuất
    public function action_logout()
    {
        Auth::dont_remember_me();
        Auth::logout();
        Session::set_flash('success', 'Bạn đã đăng xuất.');
        Response::redirect('auth/login');
    }
}
