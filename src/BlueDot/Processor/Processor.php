<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 13:30
 */

namespace BlueDot\Processor;

class Processor
{
    private $xmlReader;
    private $xmlArray;

    public function __construct($xmlFilePath) {
        if ( Validator::validate($this->xmlReader) === true) {
            $this->xmlReader = new \XMLReader();
            $this->xmlReader->open($xmlFilePath);
        }
    }

    public function run() {
        
    }
} 