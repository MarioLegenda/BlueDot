<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 13:40
 */

namespace BlueDot\Processor;


class ProcessingError
{
    private $errors = array(
        'file-not-found' => false,
        'file-not-readable' => false,
        'file-not-valid' => false
    );

    public function __construct() {

    }

    public function addError($type, $value) {
        if ( ! array_key_exists($type, $this->errors) ) {
            $this->errors['misc-error'] = $value;
            return;
        }

        $this->errors[$type] = $value;
    }

    public function getError($type) {
        if( ! array_key_exists($type, $this->errors) ) {
            return false;
        }

        return $this->errors[$type];
    }

    public function hasErrors() {
        foreach( $this->errors as $error ) {
            if( $error !== false ) {
                return true;
            }
        }

        return false;
    }

    public function getArrayedErrors() {
        $errors = array();

        array_walk($this->errors, function($value, $index) use(&$errors) {
            ( $value ) ? $errors[$index] = $value : '';
        });

        return $errors;
    }
} 