<?php

namespace Fuel\Tasks;

class Hotel
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r prefecture_seeder
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning Hotel seeder";

        $rows = [];

        $hotel_type = [
            'ビジネスホテル',
            'シティホテル',
            'リゾートホテル',
            'カプセルホテル',
            '旅館',
            'グランピング',
            'ゲストハウス',
        ];

        $hotel_type_alpha = [
            'business',
            'city',
            'resort',
            'capsule',
            'inn',
            'glamping',
            'guesthouse',
        ];

        $prefs = [
            '北海道', '青森', '秋田', '岩手', '山形', '福島', '宮城', '群馬', '栃木', '茨城', '東京', '神奈川',
            '千葉', '埼玉', '愛知', '静岡', '三重', '岐阜', '石川', '福井', '富山', '新潟', '長野', '山梨',
            '大阪', '兵庫', '京都', '滋賀', '奈良', '和歌山', '広島', '岡山', '山口', '鳥取', '島根',
            '香川', '徳島', '高知', '愛媛', '福岡', '長崎', '大分', '佐賀', '熊本', '宮崎', '鹿児島', '沖縄',
        ];

        foreach ($prefs as $pref_key => $pref_val) {
            $pref_key++;
            foreach ($hotel_type as $hotel_type_key => $hotel_type_val) {
                $name = $hotel_type_val . ' ' . $pref_val;
                $file_path = 'hotel/' . $hotel_type_alpha[$hotel_type_key] . '.png';

                if (preg_match('/ビジネスホテル|シティホテル|リゾートホテル/', $hotel_type_val) === 1) {
                    $name = $hotel_type_val . ' ' . $pref_val . ' A';

                    foreach (['B', 'C', 'D', 'E'] as $suffix) {
                        $hotel = new \Model_Hotel();
                        $hotel->name = $hotel_type_val . ' ' . $pref_val . ' ' . $suffix;
                        $hotel->prefecture_id = $pref_key;
                        $hotel->file_path = $file_path;
                        $hotel->created_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                        $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                        $hotel->save();
                    }
                }

                $hotel = new \Model_Hotel();
                $hotel->name = $name;
                $hotel->prefecture_id = $pref_key;
                $hotel->file_path = $file_path;
                $hotel->created_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                $hotel->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
                $hotel->save();
            }
        }
        
        echo "\nDone Hotel seeder";
        echo "\n===========================================";
	}

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r prefecture_seeder:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Prefecture seeder:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}

}
/* End of file tasks/prefecture_seeder.php */
