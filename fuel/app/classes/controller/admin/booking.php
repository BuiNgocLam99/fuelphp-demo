<?php

class Controller_Admin_Booking extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $this->template->title = 'Booking';
        $this->template->content = View::forge('admin/booking/index');
    }
}