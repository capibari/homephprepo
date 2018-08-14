<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 13.08.2018
 * Time: 22:56
 */

namespace core\Tools;


class Transform
{

    public static function toHash($value){
        $value .= 'asda41351351a';
        return hash('sha256', $value, false);
    }

    public static function toInt($value){
        return (int)$value;
    }

    public static function toClearStr($value){
        return htmlspecialchars(trim($value));
    }

}