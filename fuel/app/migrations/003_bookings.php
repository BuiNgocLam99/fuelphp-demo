<?php

namespace Fuel\Migrations;

class Example
{
    function up()
    {
        \DBUtil::create_table('bookings', array(
            'id' => array('type' => 'int', 'auto_increment' => true),
            'hotel_id' => array('type' => 'int'),
            'customer_name' => array('type' => 'varchar', 'constraint' => 255),
            'customer_contact' => array('type' => 'varchar', 'constraint' => 255),
            'checkin_time' => array('type' => 'timestamp'),
            'checkout_time' => array('type' => 'timestamp'),
            'created_at' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
            'updated_at' => array('type' => 'timestamp', 'null' => true, 'on update' => \DB::expr('CURRENT_TIMESTAMP')),
        ), array('id'), true);
    }

    function down()
    {
        \DBUtil::drop_table('bookings');
    }
}

