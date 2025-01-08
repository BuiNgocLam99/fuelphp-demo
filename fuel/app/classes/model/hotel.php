<?php

class Model_Hotel extends Orm\Model
{
    protected static $_properties = [
        'id',
        'prefecture_id' => [
            'data_type' => 'int',
            'label' => 'Prefecture ID',
            'validation' => [
                'required',
                'is_numeric',
                'min_length' => [1],
            ],
            'default' => null,
            'null' => true,
        ],
        'name' => [
            'data_type' => 'varchar',
            'label' => 'Hotel Name',
            'validation' => [
                'required',
                'min_length' => [2],
                'max_length' => [255],
            ],
        ],
        'file_path' => [
            'data_type' => 'text',
            'label' => 'File Path',
            'validation' => [
                'valid_url' => [],
                'max_length' => [2048],
            ],
        ],
        'status' => [
            'data_type' => 'tinyint',
            'label' => 'Status',
            'validation' => [
                'required',
                'in_array' => [[0, 1]],
            ],
            'default' => 1,
        ],
        'created_at' => [
            'data_type' => 'timestamp',
            'label' => 'Created At',
            'form' => [
                'type' => false,
            ],
        ],
        'updated_at' => [
            'data_type' => 'timestamp',
            'label' => 'Updated At',
            'form' => [
                'type' => false,
            ],
        ],
    ];

    protected static $_belongs_to = [
        'prefecture' => [
            'key_from' => 'prefecture_id',
            'model_to' => 'Model_Prefecture',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ],
    ];
    protected static $_has_many = [
        'booking_list' => [
            'key_from' => 'id',
            'model_to' => 'Model_Booking',
            'key_to' => 'hotel_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ],
    ];
}