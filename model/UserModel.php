<?php

namespace model;

use core\DB\DBDriver;
use core\Exception\ValidateException;
use core\Validators\PassValidate;
use core\Validators\Validate;


class UserModel extends BaseModel
{

    private $passValidate;

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

    public function __construct(DBDriver $db, Validate $validate, PassValidate $passValidate)
    {
        parent::__construct($db, $validate, 'user');
        $this->validate->setRules($this->validateRules);
        $this->passValidate = $passValidate;

    }

    public function signUp(array $fields)
    {
        $this->passValidate->isMatch([
            'password' => $fields['password'],
            'confirm' => $fields['confirm'],
        ]);

        if(!$this->passValidate->getSuccess()){
            throw new ValidateException($this->passValidate->getErrors());
        }

        $this->create($fields);
    }
}