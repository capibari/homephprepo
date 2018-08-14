<?php

namespace core;


class Request
{
    const GET = 'GET';
    const POST = 'POST';
    const SERVER = 'SERVER';
    const COOKIE = 'COOKIE';
    const SESSION = 'SESSION';
    const FILES = 'FILES';

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $session;
    private $files;

    public function __construct($get, $post, $server, $cookie, $session, $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->cookie = $cookie;
        $this->session = $session;
        $this->files = $files;
    }

    public function get($key = null)
    {
        return $this->getArray($this->get, $key);
    }

    public function post($key = null)
    {
        return $this->getArray($this->post, $key);
    }

    public function server($key = null)
    {
        return $this->getArray($this->server, $key);
    }

    public function cookie($key = null)
    {
        return $this->getArray($this->cookie, $key);
    }

    public function session($key = null)
    {
        return $this->getArray($this->session, $key);
    }

    public function files($key = null)
    {
        return $this->getArray($this->files, $key);
    }

    private function getArray(array $array, $key = null)
    {
       if (!$key) {
            return $array;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        return null;

    }

    private function setArray(array $array, $value, $key = null)
    {
        if (!$key && is_array($value)) {
            $array = $value;

            return true;
        }

        if (isset($array[$key]) && !is_array($value)) {
            $array[$key] = $value;

            return true;
        }

        return false;

    }

    public function isGet()
    {
        return $this->server['REQUEST_METHOD'] === self::GET;
    }

    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === self::POST;
    }

}