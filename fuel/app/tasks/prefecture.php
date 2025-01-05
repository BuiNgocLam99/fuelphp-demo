<?php

namespace Fuel\Tasks;

use DateTime;

class Prefecture
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
		echo "\nRunning Prefecture seeder";

        $rows = [
            [
                'name_jp' => '北海道',
                'name_en' => 'hokkaido',
                'file_path' => 'prefecture/hokkaido.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '青森県',
                'name_en' => 'aomori',
                'file_path' => 'prefecture/aomori.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '秋田県',
                'name_en' => 'akita',
                'file_path' => 'prefecture/akita.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '岩手県',
                'name_en' => 'iwate',
                'file_path' => 'prefecture/iwate.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '山形県',
                'name_en' => 'yamagata',
                'file_path' => 'prefecture/yamagata.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '福島県',
                'name_en' => 'fukushima',
                'file_path' => 'prefecture/fukushima.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '宮城県',
                'name_en' => 'miyagi',
                'file_path' => 'prefecture/miyagi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '群馬県',
                'name_en' => 'gunma',
                'file_path' => 'prefecture/gunma.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '栃木県',
                'name_en' => 'tochigi',
                'file_path' => 'prefecture/tochigi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '茨城県',
                'name_en' => 'ibaraki',
                'file_path' => 'prefecture/ibaraki.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '東京都',
                'name_en' => 'tokyo',
                'file_path' => 'prefecture/tokyo.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '神奈川県',
                'name_en' => 'kanagawa',
                'file_path' => 'prefecture/kanagawa.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '千葉県',
                'name_en' => 'chiba',
                'file_path' => 'prefecture/chiba.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '埼玉県',
                'name_en' => 'saitama',
                'file_path' => 'prefecture/saitama.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '愛知県',
                'name_en' => 'aichi',
                'file_path' => 'prefecture/aichi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '静岡県',
                'name_en' => 'shizuoka',
                'file_path' => 'prefecture/shizuoka.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '三重県',
                'name_en' => 'mie',
                'file_path' => 'prefecture/mie.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '岐阜県',
                'name_en' => 'gifu',
                'file_path' => 'prefecture/gifu.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '石川県',
                'name_en' => 'ishikawa',
                'file_path' => 'prefecture/ishikawa.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '福井県',
                'name_en' => 'fukui',
                'file_path' => 'prefecture/fukui.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '富山県',
                'name_en' => 'toyama',
                'file_path' => 'prefecture/toyama.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '新潟県',
                'name_en' => 'niigata',
                'file_path' => 'prefecture/niigata.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '長野県',
                'name_en' => 'nagano',
                'file_path' => 'prefecture/nagano.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '山梨県',
                'name_en' => 'yamanashi',
                'file_path' => 'prefecture/yamanashi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '大阪府',
                'name_en' => 'osaka',
                'file_path' => 'prefecture/osaka.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '兵庫県',
                'name_en' => 'hyogo',
                'file_path' => 'prefecture/hyogo.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '京都府',
                'name_en' => 'kyoto',
                'file_path' => 'prefecture/kyoto.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '滋賀県',
                'name_en' => 'shiga',
                'file_path' => 'prefecture/shiga.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '奈良県',
                'name_en' => 'nara',
                'file_path' => 'prefecture/nara.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '和歌山県',
                'name_en' => 'wakayama',
                'file_path' => 'prefecture/wakayama.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '広島県',
                'name_en' => 'hiroshima',
                'file_path' => 'prefecture/hiroshima.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '岡山県',
                'name_en' => 'okayama',
                'file_path' => 'prefecture/okayama.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '山口県',
                'name_en' => 'yamaguchi',
                'file_path' => 'prefecture/yamaguchi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '鳥取県',
                'name_en' => 'tottori',
                'file_path' => 'prefecture/tottori.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '島根県',
                'name_en' => 'shimane',
                'file_path' => 'prefecture/shimane.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '香川県',
                'name_en' => 'kagawa',
                'file_path' => 'prefecture/kagawa.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '徳島県',
                'name_en' => 'tokushima',
                'file_path' => 'prefecture/tokushima.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '高知県',
                'name_en' => 'kouchi',
                'file_path' => 'prefecture/kouchi.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '愛媛県',
                'name_en' => 'ehime',
                'file_path' => 'prefecture/ehime.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '福岡県',
                'name_en' => 'fukuoka',
                'file_path' => 'prefecture/fukuoka.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '長崎県',
                'name_en' => 'nagasaki',
                'file_path' => 'prefecture/nagasaki.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '大分県',
                'name_en' => 'ohita',
                'file_path' => 'prefecture/ohita.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '佐賀県',
                'name_en' => 'saga',
                'file_path' => 'prefecture/saga.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '熊本県',
                'name_en' => 'kumamoto',
                'file_path' => 'prefecture/kumamoto.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '宮崎県',
                'name_en' => 'miyazaki',
                'file_path' => 'prefecture/miyazaki.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '鹿児島県',
                'name_en' => 'kagoshima',
                'file_path' => 'prefecture/kagoshima.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ],
            [
                'name_jp' => '沖縄県',
                'name_en' => 'okinawa',
                'file_path' => 'prefecture/okinawa.png',
                'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
            ]
        ];

        foreach ($rows as $row) {
            $prefecture = new \Model_Prefecture();
            $prefecture->name_jp = $row['name_jp'];
            $prefecture->name_en = $row['name_en'];
            $prefecture->file_path = $row['file_path'];
            $prefecture->created_at = $row['created_at'];
            $prefecture->updated_at = $row['updated_at'];
            $prefecture->save();
        }

        echo "\nDone Prefecture seeder";
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
