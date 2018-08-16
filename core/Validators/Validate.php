<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 16.08.2018
 * Time: 23:58
 */

namespace core\Validators;


abstract class Validate
{
    protected $result;
    protected $errors;
    protected $success;

    public function __construct()
    {
        $this->result = [];
        $this->errors = [];
        $this->success = false;
    }

    public function toHash($value){
        $value .= 'asda41351351a';
        return hash('sha256', $value, false);
    }

    public function toInt($value){
        return (int)$value;
    }

    public function toClearStr($value){
        return htmlspecialchars(trim($value));
    }

    protected function isSuccess()
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

    public function getResult()
    {
        return $this->result;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}

