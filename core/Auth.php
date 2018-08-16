<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 16.08.2018
 * Time: 21:14
 */

namespace core;

use model\userModel;

class Auth
{

    private $mUser;

    public function __construct(UserModel $mUser)
    {
        $this->mUser = $mUser;
    }

    public function signUp($fields)
    {
        $this->mUser->signUp($fields);
    }
}