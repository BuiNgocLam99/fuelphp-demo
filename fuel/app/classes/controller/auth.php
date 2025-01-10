<?php

use Fuel\Core\Debug;
use Service\Email;

require_once '/var/www/html/fuel/app/classes/service/email.php';

class Controller_Auth extends Controller_Template
{
    public $template = 'auth/template';

    static public function checkAdmin()
    {
        if (!Auth::check()) {
            Response::redirect('/auth/login');
        }

        $groups = Auth::instance()->get_groups();

        if (!empty($groups[0][1]->id) && $groups[0][1]->id != 5) {
            Response::redirect('/');
        }
    }

    static public function checkClient()
    {
        if (!Auth::check()) {
            Response::redirect('/auth/login');
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
                        3
                    );
        
                    Auth::login(Input::post('username'), Input::post('password'));

                    Response::redirect('/');
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
                    
                    $groups = Auth::instance()->get_groups();

                    if (!empty($groups[0][1]->id) && ($groups[0][1]->id == 5)) {
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

    public function action_resetpassword()
    {
        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add('email', 'Email Address')
                ->add_rule('required')
                ->add_rule('valid_email');

            if ($val->run()) {
                $email = Input::post('email');

                $user = Model_User::query()->where('email', $email)->get_one();

                if (!empty($user->email)) {
                    $new_password = Str::random('alnum', 10);

                    try {
                        DB::start_transaction();

                        $user->password = Auth::instance()->hash_password($new_password);
                        $user->save();

                        $subject = 'Reset password';
                        $message = 'This is your new password: ' . $new_password;

                        Service\Email::send($user, $subject, $message);

                        DB::commit_transaction();

                        Session::set_flash('success', 'Password reset successfully. Please check your email.');
                    } catch (Exception $e) {
                        DB::rollback_transaction();

                        Session::set_flash('error', 'Failed to reset password. Please try again.');
                    }
                } else {
                    Session::set_flash('error', 'Email address not found.');
                }
            } else {
                $data['errors'] = $val->error();
            }
        }

        $this->template->title = 'Reset password';
        $this->template->content = View::forge('auth/resetpassword');
    }

    public function action_changepassword()
    {
        $params = [];

        if (Input::method() == 'POST') {
            $password = Input::post('password');

            $val = Validation::forge();
            $val->add('password', 'New Password')
                ->add_rule('required')
                ->add_rule('min_length', 6);

            if ($val->run()) {
                $user = Auth::instance()->get_user();
                $userModel = Model_User::find($user->id);
                
                if ($userModel) {
                    $userModel->password = Auth::instance()->hash_password($password);
                    $userModel->save();

                    Session::set_flash('success', 'Password has been updated successfully!');
                    Response::redirect('auth/changepassword');
                } else {
                    Session::set_flash('error', 'User not found!');
                    Response::redirect('auth/changepassword');
                }
            } else {
                $params = [
                    'errors' => $val->error(),
                    'email' => Input::post('email'),
                    'password' => Input::post('password')
                ];
            }
        }

        $this->template->title = 'Change Password';
        $this->template->content = View::forge('auth/changepassword', $params);
    }

    public function action_logout()
    {
        Auth::dont_remember_me();
        Auth::logout();

        $referrer = Input::server('HTTP_REFERER') ? Input::server('HTTP_REFERER') : '/';

        Response::redirect($referrer);
    }
}
