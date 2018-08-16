<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 16.08.2018
 * Time: 21:14
 */

namespace core;

use core\Exception\ValidateException;
use core\Validators\PassValidate;
use model\userModel;

class Auth
{

    private $mUser;
    private $passValidate;

    public function __construct(UserModel $mUser,  PassValidate $passValidate)
    {
        $this->mUser = $mUser;
        $this->passValidate = $passValidate;
    }

    public function signUp($fields)
    {
        $this->comparePasswords([
            'password' => $fields['password'],
            'confirm' => $fields['confirm']
            ]);

        $this->mUser->signUp($fields);
    }

    public function updatePassword($fields, $oldPassHash, $id)
    {
        $this->comparePasswords([
            'checkExistsPassword' => $this->passValidate->toHash($fields['oldPassword']),
            'existsPassword' => $oldPassHash
        ]);

        $this->comparePasswords([
            'password' => $fields['password'],
            'confirm' => $fields['confirm']
        ]);

        $params['id'] =$id;
        $params['password'] = $fields['password'];

        $this->mUser->update($params);
    }

    private function comparePasswords(array $params)
    {
        $this->passValidate->isMatch($params);

        if(!$this->passValidate->getSuccess()){
            throw new ValidateException($this->passValidate->getErrors());
        }

    }

}