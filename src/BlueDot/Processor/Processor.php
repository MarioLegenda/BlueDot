<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 13:30
 */

namespace BlueDot\Processor;

use BlueDot\Processor\ProcessorExceptions\ProcessingException;
use BlueDot\Processor\Validator;

class Processor
{
    private $xmlReader;

    public function __construct(Validator $validator) {
        $xmlReader = new \XMLReader();
        $validated = $validator->validate($xmlReader);
        if( $validator->validate($xmlReader) instanceof ProcessingError ) {
            throw new ProcessingException($validated);
        }

        $this->xmlReader = $xmlReader;

        return true;
    }
} 