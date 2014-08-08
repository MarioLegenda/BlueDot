<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 13:32
 */

namespace BlueDot\Processor;

class Validator
{
    private $errors;
    private $xmlFilePath;

    public function __construct($xmlFilePath) {
        $this->errors = new ProcessingError();
        if( ! file_exists($xmlFilePath) ) {
            $this->errors->addError('file-not-found', 'File ' . $xmlFilePath . ' is not where it should be');
            return;
        }

        if( ! is_readable($xmlFilePath) ) {
            $this->errors->addError('file-not-readable', 'File ' . $xmlFilePath . ' is not where it should be');
            return;
        }

        $this->xmlFilePath = $xmlFilePath;
    }

    public function validate(\XMLReader &$reader) {
        $reader->open($this->xmlFilePath);
    }
} 