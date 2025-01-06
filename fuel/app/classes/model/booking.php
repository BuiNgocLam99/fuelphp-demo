<?php

class Model_Booking extends Orm\Model
{
    protected static $_properties = [
        'id',
        'user_id',
        'hotel_id',
        'customer_name',
        'customer_contact',
        'checkin_time',
        'checkout_time',
        'created_at',
        'updated_at',
    ];

    protected static $_created_at = 'created_at';
    protected static $_updated_at = 'updated_at';

    protected static $_belongs_to = [
        'user' => [
            'key_from' => 'user_id',
            'model_to' => 'Model_User',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ],
        'hotel' => [
            'key_from' => 'hotel_id',
            'model_to' => 'Model_Hotel',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ],
    ];
}