<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 11:01
 */

namespace BlueDot\Statement\Exception;


class StatementException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 