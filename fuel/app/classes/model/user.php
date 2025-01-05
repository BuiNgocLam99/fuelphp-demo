<?php

class Model_User extends Orm\Model
{
    protected static $_properties = [
        'id',
        'name' => [
            'data_type' => 'varchar',
            'label' => 'Name',
            'validation' => [
                'required', 
                'min_length' => [2],
                'max_length' => [255],
            ],
        ],
        'email' => [
            'data_type' => 'varchar',
            'label' => 'Email',
            'validation' => [
                'required',
                'valid_email',
                'unique',
            ],
        ],
        'password' => [
            'data_type' => 'varchar',
            'label' => 'Password',
            'validation' => [
                'required',
                'min_length' => [6],
            ],
        ],
        'is_admin' => [
            'data_type' => 'tinyint',
            'label' => 'Is Admin',
            'validation' => [
                'in_array' => [0, 1],
            ],
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

    protected static $_to_array_exclude = [
        'password'
    ];
}