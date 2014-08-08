<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 11:24
 */

namespace BlueDot\GlobalException;

use BlueDot\SyntaxEvaluator\SyntaxError;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class GlobalException extends \Exception
{
    public function __construct() {

    }

    protected function sendToScreen($message) {
        if( $message instanceof SyntaxError ) {
            $errors = $message->getArrayedErrors();

            $errCounter = 1;
            array_walk($errors, function($value, $index) use (&$errCounter) {

                $this->message .= 'Error ' . $errCounter . ': ' . $value;
                $errCounter++;
            });
        } else if( is_string($message) ) {
            $this->message = $message;
        }
    }

    protected function sendToLog($message) {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('error.log', Logger::ERROR));

        if( $message instanceof SyntaxError ) {
            $errors = $message->getArrayedErrors();

            $errCounter = 1;
            array_walk($errors, function($value, $index) use (&$errCounter, &$message) {

                $message .= 'Error ' . $errCounter . ': ' . $value;
                $errCounter += 1;
            });
        }

        $log->addError($message);
    }
} 