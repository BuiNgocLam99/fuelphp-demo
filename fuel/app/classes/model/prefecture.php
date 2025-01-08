<?php

class Model_Prefecture extends Orm\Model
{
    protected static $_properties = [
        'id',
        'name_jp' => [
            'data_type' => 'varchar',
            'label' => 'Prefecture Name (Japanese)',
            'validation' => [
                'required',
                'min_length' => [2],
                'max_length' => [255],
            ],
        ],
        'name_en' => [
            'data_type' => 'varchar',
            'label' => 'Prefecture Name (English)',
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

    protected static $_has_many = [
        'hotels' => [
            'key_from' => 'id',
            'model_to' => 'Model_Hotel',
            'key_to' => 'prefecture_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ],
    ];
}