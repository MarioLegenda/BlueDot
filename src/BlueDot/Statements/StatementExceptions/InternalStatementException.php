<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 11:18
 */

namespace BlueDot\Statements\StatementExceptions;

use BlueDot\GlobalException\GlobalException;

class InternalStatementException extends GlobalException
{
    public function __construct($message) {
        $this->sendToLog($message);
    }
} 