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
            ->limit(18)
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
}
