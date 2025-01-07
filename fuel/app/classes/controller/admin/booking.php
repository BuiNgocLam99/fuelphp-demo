<?php

class Controller_Admin_Booking extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/booking'),
            'total_items'    => Model_Booking::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );
        
        $pagination = Pagination::forge('pagination', $config);

        $data['booking_list'] = Model_Booking::query()
            ->related('hotel')
            ->related('hotel.prefecture')
            ->related('user')
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        $data['pagination'] = $pagination;

        $this->template->title = 'Booking list';
        $this->template->content = View::forge('admin/booking/index', $data);
    }
}