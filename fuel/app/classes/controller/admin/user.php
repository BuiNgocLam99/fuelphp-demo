<?php

class Controller_Admin_User extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $this->template->title = 'User';
        $this->template->content = View::forge('admin/user/index');
    }
}