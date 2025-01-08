<?php

class Controller_Admin_Booking extends Controller_Template
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        Controller_Auth::checkAdmin();

        $this->template->title = 'Booking';
    }

    public function action_index()
    {
        $filter = Input::get('filter');
        $search = trim(Input::get('search'));

        $data = [];

        $config = array(
            'pagination_url' => Uri::create('admin/booking', [], [
                'filter' => $filter,
                'search' => $search,
            ]),
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

        if ($search) {
            $searchFields = [
                'user.username',
                'user.email',
                'hotel.prefecture.name_en',
                'hotel.prefecture.name_jp',
                'hotel.name',
            ];
        
            $query->where_open();
            foreach ($searchFields as $field) {
                $query->or_where($field, 'like', '%' . trim($search) . '%');
            }
            $query->where_close();
        }

        if ($filter && $filter === 'oldest') {
            $query->order_by('id', 'desc');
        }

        $data['booking_list'] = $query->get();
        $data['pagination'] = $pagination;
        $data['search'] = $search;

        $this->template->content = View::forge('admin/booking/index', $data);
    }
}