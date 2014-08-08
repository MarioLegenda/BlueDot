<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 13:32
 */

namespace BlueDot\Processor;

use BlueDot\Processor\ProcessorExceptions\ProcessingException;

class Validator
{
    public static function validate($xmlFilePath) {
        if( ! file_exists($xmlFilePath) ) {
            $errors = new ProcessingError();
            $errors->addError('file-not-found', 'File ' . $xmlFilePath . ' is not where it should be');
            throw new ProcessingException($errors);
        }

        if( ! is_readable($xmlFilePath) ) {
            $errors = new ProcessingError();
            $errors->addError('file-not-readable', 'File ' . $xmlFilePath . ' is not where it should be');
            throw new ProcessingException($errors);
        }

        return true;
    }
} 