<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 01.08.2018
 * Time: 21:39
 */

namespace controller;

use core\Templater;
use core\Request;

abstract class BaseController
{
    protected $title;
    protected $content;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->title = 'Блог';
        $this->content = '';
    }

    public function build()
    {
        echo Templater::buildHtmlView('index', [
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }

    protected function redirect($uri, $id = null)
    {
        if($id){
            header(sprintf('Location: %s\%s', $uri, $id));
            exit;
        }

        header(sprintf("Location: %s", $uri));
        exit;
    }

     protected function render($uri, $params = [])
     {
         $this->content = Templater::buildHtmlView($uri, $params);
     }

}