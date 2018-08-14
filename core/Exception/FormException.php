<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 14.08.2018
 * Time: 0:07
 */

namespace core\Exception;


class FormException extends \Exception
{
    private $error;

    public function __construct($error)
    {
        parent::__construct();
        $this->errors = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}


