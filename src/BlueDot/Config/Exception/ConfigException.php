<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 10:11
 */

namespace BlueDot\Config\Exception;


class ConfigException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 