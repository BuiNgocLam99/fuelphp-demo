<?php

use Fuel\Core\Pagination;

class Controller_Admin_Prefecture extends Controller_Template
{
    public $template = 'admin/template';

    public function action_index()
    {
        $data = [];

        // Lấy tổng số bản ghi
        $total_count = Model_Prefecture::count();

        // Cấu hình phân trang
        $pagination = Pagination::forge('mypagination', [
            'pagination_url' => Uri::create('admin/prefecture'),
            'total_items'    => $total_count,
            'per_page'       => 10, // Số bản ghi trên mỗi trang
            'uri_segment'    => 3,  // Segment URI chứa số trang
            'num_links'      => 5,  // Số liên kết hiển thị
        ]);

        // Lấy danh sách Prefecture với phân trang
        $data['prefectures'] = Model_Prefecture::query()
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();

        // Gắn phân trang vào dữ liệu
        $data['pagination'] = $pagination->render();

        $this->template->title = 'Prefecture';
        $this->template->content = View::forge('admin/prefecture/index', $data);
    }
}
