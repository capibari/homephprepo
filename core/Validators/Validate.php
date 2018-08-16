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
            foreach ($this->rules as $fieldName => $rules){

                if (!isset($fields[$fieldName]) || $fields[$fieldName] == self::EMPTY_STR && !$this->isRequire($rules)) {
                    continue;
                }

//                if (!isset($fields[$name]) && $this->isRequire($rules)){
//                    $this->errors[$name][] = sprintf('Нету поля %s', $name);
//                    continue;
//                }

                if (isset($rule[self::NOT_BLANK]) && $this->isBlank( $fields[$fieldName])){
                    $this->errors[$fieldName][] = sprintf('Поле %s не может быть пустым', $fieldName);
                }

                if (isset($rules[self::TYPE]) && !$this->isType($rules[self::TYPE], $fields[$fieldName])){
                    $this->errors[$fieldName][] = sprintf('Поле %s должно быть %s', $fieldName,  $rules[self::TYPE]);
                }

                if (isset($rules[self::MIN_LENGTH]) && $this->isMinLength($fields[$fieldName], $rules[self::MIN_LENGTH])){
                    $this->errors[$fieldName][] = sprintf('Поле %s не должно быть меньше %s символов', $fieldName, $rules[self::MIN_LENGTH]);
                }

                if (isset($rules[self::MAX_LENGTH]) && $this->isMaxLength($fields[$fieldName], $rules[self::MAX_LENGTH])) {
                    $this->errors[$fieldName][] = sprintf('Поле %s не должно превыщать %s символов', $fieldName, $rules[self::MAX_LENGTH]);
                }

                if ((isset($rules[self::SPEC_CHARS]) && $rules[self::SPEC_CHARS]) && !$this->isSpecChars($fields[$fieldName])) {
                    $this->errors[$fieldName][] = sprintf('Поле %s может содержать только буквы или цифры', $fieldName, $rules[self::MIN_LENGTH]);
                }

                if(empty($this->errors[$fieldName])){
                    $this->setResult($rules, $fields, $fieldName);
                }

            }

            $this->isSuccess();
        }
    }

    private function isSuccess()
    {
        if(!$this->errors){
            $this->success = true;
        }

        return false;
    }

    private function setResult($rules, $fields, $fieldName)
    {

        if(isset($rules[self::TYPE]) && $rules[self::TYPE] == self::STRING){
            $this->result[$fieldName] = Transform::toClearStr($fields[$fieldName]);
        } else if (isset($rules[self::TYPE]) && $rules[self::TYPE] == self::INT){
            $this->result[$fieldName] = Transform::toInt($fields[$fieldName]);
        }
        if ($fieldName === self::PASSWORD){
            $this->result[$fieldName] = Transform::toHash($fieldName);
        }
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


