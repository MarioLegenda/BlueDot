<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 14:06
 */

namespace BlueDot\Processor\ProcessorExceptions;


use BlueDot\GlobalException\GlobalException;

class ProcessingException extends GlobalException
{
    public function __construct($message) {
        $this->sendToScreen($message);
    }
} 