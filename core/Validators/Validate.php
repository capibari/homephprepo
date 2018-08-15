<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 05.08.2018
 * Time: 17:01
 */

namespace core\Validators;

use core\Exception\ValidateException;
use core\Tools\Transform;

class Validate
{
    const IS_REQUIRE = 'require';
    const TYPE = 'type';
    const INT = 'integer';
    const STRING = 'string';
    const NOT_BLANK = 'not_blank';
    const MIN_LENGTH ='min_length';
    const MAX_LENGTH = 'max_length';
    const SPEC_CHARS = 'special_chars';
    const DOT = '.';
    const COMA = ',';
    const SUCCESS = 'success';
    const ZERO = 0;
    const CONFIRM = 'confirm';
    const EMPTY_STR = '';
    const PASSWORD = 'password';


    public $rules = [];
    public $result = [];
    public $errors = [];
    public $success;

    public function __construct()
    {
       $this->success = false;
    }

    public function execute(array $fields)
    {

        if($this->rules){
            foreach ($this->rules as $name => $rules){

                if (!isset($fields[$name]) || $fields[$name] == self::EMPTY_STR && !$this->isRequire($rules)) {
                    continue;
                }

//                if (!isset($fields[$name]) && $this->isRequire($rules)){
//                    $this->errors[$name][] = sprintf('Нету поля %s', $name);
//                    continue;
//                }

                if (isset($rule[self::NOT_BLANK]) && $this->isBlank( $fields[$name])){
                    $this->errors[$name][] = sprintf('Поле %s не может быть пустым', $name);
                }

                if (isset($rules[self::TYPE]) && !$this->isType($rules[self::TYPE], $fields[$name])){
                    $this->errors[$name][] = sprintf('Поле %s должно быть %s', $name,  $rules[self::TYPE]);
                }

                if (isset($rules[self::MIN_LENGTH]) && $this->isMinLength($fields[$name], $rules[self::MIN_LENGTH])){
                    $this->errors[$name][] = sprintf('Поле %s не должно быть меньше %s символов', $name, $rules[self::MIN_LENGTH]);
                }

                if (isset($rules[self::MAX_LENGTH]) && $this->isMaxLength($fields[$name], $rules[self::MAX_LENGTH])) {
                    $this->errors[$name][] = sprintf('Поле %s не должно превыщать %s символов', $name, $rules[self::MAX_LENGTH]);
                }

                if ((isset($rules[self::SPEC_CHARS]) && $rules[self::SPEC_CHARS]) && !$this->isSpecChars($fields[$name])) {
                    $this->errors[$name][] = sprintf('Поле %s может содержать только буквы или цифры', $name, $rules[self::MIN_LENGTH]);
                }

                if(empty($this->errors[$name])){
                    if(isset($rules[self::TYPE]) && $rules[self::TYPE] == self::STRING){
                        $this->result[$name] = Transform::toClearStr($fields[$name]);
                    } else if (isset($rules[self::TYPE]) && $rules[self::TYPE] == self::INT){
                        $this->result[$name] = Transform::toInt($fields[$name]);
                    }
                    if ($name === self::PASSWORD){
                        $this->result[$name] = Transform::toHash($fields[$name]);
                    }

                }

            }

            $this->checkErrors();

            $this->success = true;
        }
    }



    private function checkErrors()
    {
        if($this->errors){
            throw new ValidateException($this->errors);
        }

        return false;
    }


    private function isRequire($rule)
    {
        return (isset($rule[self::IS_REQUIRE]) && $rule[self::IS_REQUIRE]);
    }


    private function isType($rule, $field)
    {
        switch ($rule){
            case self::INT:
                return is_numeric($field) && !strpos($field, self::DOT) && !strpos($field, self::COMA);
                break;
            case self::STRING:
                return is_string($field);
                break;
            default:
                return new ValidateException('Wrong TYPE');
                break;

        }
    }

    private function isBlank($field)
    {
        return strlen($field) == self::ZERO;
    }

    private function isMinLength($field, $min)
    {
       return iconv_strlen($field) < $min;
    }

    private function isMaxLength($field, $max)
    {
        return iconv_strlen($field) > $max;
    }

    private function isSpecChars($field)
    {
        return preg_match("/^[a-zа-яё\d\w]*$/i",$field);
    }

    public function setRules(array $rules = [])
    {
        $this->rules = $rules;
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


