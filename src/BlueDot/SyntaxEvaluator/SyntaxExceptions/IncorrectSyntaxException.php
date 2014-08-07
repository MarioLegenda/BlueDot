<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 16:37
 */

namespace BlueDot\SyntaxEvaluator\SyntaxExceptions;


use BlueDot\SyntaxEvaluator\SyntaxError;

class IncorrectSyntaxException extends \Exception
{
    public function __construct($message) {
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
} 