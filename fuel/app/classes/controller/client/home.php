<?php

use Fuel\Core\Controller_Template;
use Fuel\Core\Debug;
use Fuel\Core\Response;
use Fuel\Core\View;

class Controller_Client_Home extends Controller_Template
{
    public $template = 'client/template';

	public function action_index()
	{
        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');
        $data['hotels'] = Model_Hotel::query()
            ->related('prefecture')
            ->limit(19)
            ->get();

        $this->template->content = View::forge('client/hotel/index', $data);
	}

    public function action_prefecture()
    {
        $prefecture_id = $this->param('prefecture_id');

        $data = [];

        $data['prefectures'] = Model_Prefecture::find('all');

        $prefecture = Model_Prefecture::query()
            ->related('hotels')
            ->related('hotels.prefecture')
            ->where('id', $prefecture_id)
            ->get_one();

        $data['hotels'] = $prefecture === null ? [] : $prefecture->hotels;

        $this->template->content = View::forge('client/hotel/index', $data);
    }

    public function action_hotel()
    {
        $prefecture_id = $this->param('prefecture_id');
        $hotel_id = $this->param('hotel_id');

        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');
        $data['hotel'] = Model_Hotel::find($hotel_id);

        $prefecture = Model_Prefecture::query()
            ->related('hotels')
            ->related('hotels.prefecture')
            ->where('id', $prefecture_id)
            ->get_one();

        $data['related_hotels'] = $prefecture === null ? [] : $prefecture->hotels;

        $this->template->content = View::forge('client/hotel/detail', $data);
    }

    public function action_search()
    {
        $data = [];
        $data['prefectures'] = Model_Prefecture::find('all');

        $query = Input::get('query', '');

        if (empty($query)) {
            $data['hotels'] = Model_Hotel::query()
                ->related('prefecture')
                ->limit(19)
                ->get();
        } else {
            $data['hotels'] = Model_Hotel::query()
                ->related('prefecture')
                ->where('name', 'LIKE', "%$query%")
                // ->or_where('prefecture.name_jp', 'LIKE', "%$query%")
                // ->or_where('prefecture.name_en', 'LIKE', "%$query%")
                ->limit(19)
                ->get();
        }

        $this->template->content = View::forge('client/hotel/index', $data);
    }
}
