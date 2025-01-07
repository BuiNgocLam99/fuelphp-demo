<?php

class Controller_Admin_Booking extends Controller_Template
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        $this->template->title = 'Booking';
    }

    public function action_index()
    {
        $filter = Input::get('filter');

        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/booking'),
            'total_items'    => Model_Booking::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
        );
        
        $pagination = Pagination::forge('pagination', $config);

        $query = Model_Booking::query()
            ->related('user')
            ->related('hotel')
            ->related('hotel.prefecture')
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page);

        if ($filter && $filter === 'oldest') {
            $query->order_by('id', 'desc');
        }

        $data['booking_list'] = $query->get();
        $data['pagination'] = $pagination;

        $this->template->content = View::forge('admin/booking/index', $data);
    }
}