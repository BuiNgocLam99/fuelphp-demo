<?php

class Controller_Admin_Hotel extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $this->template->title = 'Hotel';
        $this->template->content = View::forge('admin/hotel/index');
    }
}