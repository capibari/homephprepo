<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 03.08.2018
 * Time: 2:28
 */

namespace controller;

use core\Templater;

class ErrorController extends BaseController
{
    public function getError404($value)
    {
        Header("HTTP/1.0 404 Not Found");
        $this->content = Templater::buildHtmlView('error\404', [
            'value' => $value,
        ]);
    }
}