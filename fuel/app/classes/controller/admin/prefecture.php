<?php

use Fuel\Core\Debug;
use Fuel\Core\Pagination;

class Controller_Admin_Prefecture extends Controller_Template
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        Controller_Auth::checkAdmin();

        $this->template->title = 'Prefecture';
    }

    public function action_index()
    {
        $filter = Input::get('filter');
        $search = trim(Input::get('search'));

        $data = [];

        $query = Model_Prefecture::query();

        if ($search) {
            $query->where('name_jp', 'like', '%' . $search . '%')
                ->or_where('name_en', 'like', '%' . $search . '%');
        }

        $total_items = $query->count();

        $config = array(
            'pagination_url' => Uri::create('admin/prefecture', [], [
                'filter' => $filter,
                'search' => $search,
            ]),
            'total_items'    => $total_items,
            'per_page'       => 10,
            'uri_segment'    => 3,
        );

        $pagination = Pagination::forge('pagination', $config);

        $query->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page);

        if ($filter && $filter === 'oldest') {
            $query->order_by('id', 'desc');
        }

        $data['prefectures'] = $query->get();
        $data['pagination'] = $pagination;
        $data['search'] = $search;

        $this->template->content = View::forge('admin/prefecture/index', $data);
    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $name_jp = Input::post('name_jp');
            $name_en = Input::post('name_en');

            $val = Validation::forge();

            $val->add_field('name_jp', 'Japanese Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('name_en', 'English Name', 'required|min_length[2]|max_length[255]');

            if ($val->run()) {
                $prefecture = Model_Prefecture::forge();
                $prefecture->name_jp = $name_jp;
                $prefecture->name_en = $name_en;
                $prefecture->created_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                $prefecture->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');

                if ($prefecture->save()) {
                    Session::set_flash('success', 'Prefecture created successfully! <br><a href="/admin/prefecture">Prefecture list</a>');
                } else {
                    Session::set_flash('error', 'The prefecture already exists or an error occurred.');
                }
            } else {
                $this->template->set_global('errors', $val->error());
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $this->template->content = View::forge('admin/prefecture/create');
    }

    public function action_edit($id = null)
    {
        if (is_null($id) || !$prefecture = Model_Prefecture::find($id)) {
            Session::set_flash('error', 'Prefecture not found.');
            Response::redirect('/admin/prefecture');
        }

        if (Input::method() == 'POST') {
            $name_jp = Input::post('name_jp');
            $name_en = Input::post('name_en');

            $val = Validation::forge();

            $val->add_field('name_jp', 'Japanese Name', 'required|min_length[2]|max_length[255]');
            $val->add_field('name_en', 'English Name', 'required|min_length[2]|max_length[255]');

            if ($val->run()) {
                $prefecture->name_jp = $name_jp;
                $prefecture->name_en = $name_en;
                $prefecture->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');

                if ($prefecture->save()) {
                    Session::set_flash('success', 'Prefecture updated successfully! <br><a href="/admin/prefecture">Prefecture list</a>');
                } else {
                    Session::set_flash('error', 'There was a problem updating the prefecture.');
                }
            } else {
                $this->template->set_global('errors', $val->error());
                Session::set_flash('error', 'There were errors in the form!');
            }
        }

        $this->template->set_global('prefecture', $prefecture, false);
        $this->template->content = View::forge('admin/prefecture/edit');
    }
}
