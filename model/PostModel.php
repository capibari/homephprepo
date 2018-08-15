<?php

namespace model;

use core\DB\DBDriver;
use core\Validators\Validate;

class PostModel extends BaseModel
{
    private $validateRules = [
        'id' => [
            'type' => 'integer',
        ],

        'title' => [
            'type' => 'string',
            'min_length' => 3,
            'max_length' => 250,
            'require' => true,
            'not_blank' => true
        ],

        'content' => [
            'type' => 'string',
            'min_length' => 3,
            'require' => true,
            'not_blank' => true
        ],

        'date' =>[
            'type' => 'integer',
            'require' => true,
        ]
    ];

    public function __construct(DBDriver $db, Validate $validate)
    {
        parent::__construct($db, $validate, 'article');
        $this->validate->setRules($this->validateRules);
    }
}