<?php

namespace model;

use core\DB\DBDriver;
use core\Exception\ValidateException;
use core\Validators\PassValidate;
use core\Validators\FormValidate;


class UserModel extends BaseModel
{

    private $validateRules = [
        'id' => [
            'type' => 'integer',
        ],

        'login' => [
            'type' => 'string',
            'min_length' => 4,
            'max_length' => 16,
            'require' => true,
            'special_chars' => false,
            'not_blank' => true
        ],

        'password' => [
            'type' => 'string',
            'min_length' => 4,
            'max_length' => 16,
            'require' => true,
            'special_chars' => false,
            'not_blank' => true,
        ],

        'name' => [
            'type' => 'string',
            'min_length' => 4,
            'max_length' => 16,
            'require' => false,
            'special_chars' => false,
            'not_blank' => true
        ],

        'date' => [
            'type' => 'integer',
        ]
    ];

    public function __construct(DBDriver $db, FormValidate $validate)
    {
        parent::__construct($db, $validate, 'user');
        $this->validate->setRules($this->validateRules);


    }

    public function signUp(array $fields)
    {
        $this->create($fields);
    }
}