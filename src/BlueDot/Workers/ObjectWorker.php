<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 16:55
 */

namespace BlueDot\Workers;


use BlueDot\Workers\Exception\ClosureDependencyException;
use BlueDot\Workers\Interfaces\ClosureDependencyInterface;
use BlueDot\Workers\Interfaces\WorkerInterface;

class ObjectWorker implements WorkerInterface, ClosureDependencyInterface
{
    private $result = array();

    public function __construct() {

    }

    public function addFromClosure($variable, $value) {
        if( ! property_exists($this, $variable) ) {
            throw new ClosureDependencyException("Instance variable " . $variable . " does not exist in FileWorker::addFromClosure()");
        }

        $this->{$variable} = $value;
    }

    public function addOptions(array $options) {
        return $this;
    }

    public function search() {

        return $this;
    }

    public function getResult() {
        return $this->result;
    }
} 