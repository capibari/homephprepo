<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 13.08.2018
 * Time: 22:51
 */

namespace core\Validators;
use core\Exception\ValidateException;


class PassValidate
{
    public $errors = [];
    public $success = false;

    public function isMatch(array $array)
    {
        $name = array_keys($array);

        if (!array_search(array_shift($array), $array)) {
            $this->errors[$name[0]][] = sprintf('Поле %s не совпадает с %s', $name[0], $name[1]);
        }

        $this->isSuccess();

        return true;
    }

    private function isSuccess()
    {
        if(!$this->errors){
            $this->success = true;
        }

        return false;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}