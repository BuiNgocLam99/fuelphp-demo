<?php

namespace Fuel\Migrations;

class Example
{
    function up()
    {
        \DBUtil::create_table('prefectures', array(
            'id' => array('type' => 'int', 'auto_increment' => true),
            'name_jp' => array('type' => 'varchar', 'constraint' => 255, 'comment' => 'Prefecture name in Japanese'),
            'name_en' => array('type' => 'varchar', 'constraint' => 255, 'comment' => 'Prefecture name in English'),
            'file_path' => array('type' => 'text', 'null' => true),
            'created_at' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
            'updated_at' => array('type' => 'timestamp', 'null' => true, 'on update' => \DB::expr('CURRENT_TIMESTAMP')),
        ), array('id'));
    }

    function down()
    {
        \DBUtil::drop_table('prefectures');
    }
}

