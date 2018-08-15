<?php

namespace core;


class UrlManager
{

    public static function getController()
    {
        $array = self::getUriArray();
        $controller = (isset($array[0]) && $array[0] != '') ? $array[0] : 'post';
        return sprintf('controller\%sController', ucfirst($controller));
    }

    public static function getAction()
    {
        $array = self::getUriArray();
        if(isset($array[1]) && $array[1] != '' && !is_numeric($array[1])){
            $action = $array[1];
        } else if (isset($array[1]) && is_numeric($array[1])){
            $action = $array[0];
        } else $action = 'index';

        $actionParts = explode('-', $action);
        $action = '';

        foreach($actionParts as $part){
            $action = sprintf('%s%s', $action, ucfirst($part));
        }

        return sprintf('action%s', $action);
    }

    public static function getId()
    {
        $array = self::getUriArray();
        if(isset($array[2]) && is_numeric($array[2])){
            return $array[2];
        } else if(isset($array[1]) && is_numeric($array[1])){
            return $array[1];
        } else return null;
    }

    private static function getUriArray()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);

        unset($uriParts[0]);
        return array_values($uriParts);
    }


}





