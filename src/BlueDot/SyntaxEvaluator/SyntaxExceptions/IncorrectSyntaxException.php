<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 16:37
 */

namespace BlueDot\SyntaxEvaluator\SyntaxExceptions;

use BlueDot\GlobalException\GlobalException;

class IncorrectSyntaxException extends GlobalException
{
    public function __construct($message) {
        $this->sendToScreen($message);
    }
} 