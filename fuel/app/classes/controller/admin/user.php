<?php

class Controller_Admin_User extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/user'),
            'total_items'    => Model_User::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );
        
        $pagination = Pagination::forge('pagination', $config);

        $data['users'] = Model_User::query()
            ->related('booking_list')
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        $data['pagination'] = $pagination;

        $this->template->title = 'Users';
        $this->template->content = View::forge('admin/user/index', $data);
    }
}