<?php

class Controller_Auth extends Controller_Template
{
    public $template = 'auth/template';

    static public function checkAdmin()
    {
        if (!Auth::check()) {
            Response::redirect('/auth/login');
        }

        $groups = Auth::instance()->get_groups();
        if (empty($groups) || $groups[0][1]->id != 5) {
            Response::redirect('/');
        }
    }

    public function action_register()
    {
        $params = [];

        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add_field('username', 'Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('email', 'Email', 'required|valid_email');
            $val->add_field('password', 'Password', 'required|min_length[6]');

            if ($val->run()) {
                try {
                    Auth::create_user(
                        Input::post('username'),
                        Input::post('password'),
                        Input::post('email'),
                        0
                    );
        
                    return Response::forge(json_encode([
                        'status' => 'success',
                        'message' => 'Registration successful.',
                    ]), 200);
                } catch (SimpleUserUpdateException $e) {
                    $params = [
                        'errors' => [
                            'username' => 'Username or email already exists.'
                        ],
                        'username' => Input::post('username'),
                        'email' => Input::post('email'),
                        'password' => Input::post('password')
                    ];
                }
            } else {
                $params = [
                    'errors' => $val->error(),
                    'username' => Input::post('username'),
                    'email' => Input::post('email'),
                    'password' => Input::post('password')
                ];
            }
        }

        $this->template->title = 'Register';
        $this->template->content = View::forge('auth/register', $params);
    }
    public function action_login()
    {
        if (Auth::check()) {
            Response::redirect('/');
        }
    
        $params = [];

        $prefecture = Input::post('prefecture');
        $hotel = Input::post('hotel');

        $redirect_to = ($prefecture && $hotel) ? "/prefecture/$prefecture/hotel/$hotel" : '';

        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add('email', 'Email Address')->add_rule('required')->add_rule('valid_email');
            $val->add('password', 'Password')->add_rule('required');
    
            if ($val->run()) {
                $auth = Auth::instance();
                if ($auth->login(Input::post('email'), Input::post('password'))) {
                    
                    if (Input::post('remember-me', false)) {
                        Auth::remember_me();
                    } else {
                        Auth::dont_remember_me();
                    }

                    $groups = Auth::instance()->get_groups();

                    if ($groups[0][1]->id == 5) {
                        Response::redirect('/admin');
                    }

                    Response::redirect($redirect_to);
                } else {
                    $params = [
                        'errors' => ['login' => 'Incorrect email or password.'],
                        'email' => Input::post('email'),
                        'password' => Input::post('password')
                    ];
                }
            } else {
                $params = [
                    'errors' => $val->error(),
                    'email' => Input::post('email'),
                    'password' => Input::post('password')
                ];
            }
        }
    
        $this->template->title = 'Login';
        $this->template->content = View::forge('auth/login', $params);
    }

    public function action_logout()
    {
        Auth::dont_remember_me();
        Auth::logout();

        $referrer = Input::server('HTTP_REFERER') ? Input::server('HTTP_REFERER') : '/';

        Response::redirect($referrer);
    }
}
