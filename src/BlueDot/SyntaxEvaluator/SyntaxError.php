<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 16:59
 */

namespace BlueDot\SyntaxEvaluator;


class SyntaxError
{
    private $errors = array(
        'unknown-order' => '',
        'unknown-select' => '',
        'unknown-attr' => '',
        'misc-error' => ''
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

    public function getArrayedErrors() {
        $errors = array();

        array_walk($this->errors, function($value, $index) use(&$errors) {
            ( $value ) ? $errors[$index] = $value : '';
        });

        return $errors;
    }
} 