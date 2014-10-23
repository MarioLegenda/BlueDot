<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 14:13
 */

namespace BlueDot\Workers\Exception;


class WorkerException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 