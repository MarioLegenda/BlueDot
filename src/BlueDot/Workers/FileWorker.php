<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 11:57
 */

namespace BlueDot\Workers;

use BlueDot\Workers\Exception\ClosureDependencyException;
use BlueDot\Workers\Interfaces\ClosureDependencyInterface;
use BlueDot\Workers\Interfaces\WorkerInterface;

class FileWorker implements WorkerInterface, ClosureDependencyInterface
{
    private $handle;
    private $options = array();

    private $result;

    public function __construct() {

    }

    public function addFromClosure($variable, $value) {
        if( ! property_exists($this, $variable) ) {
            throw new ClosureDependencyException("Instance variable " . $variable . " does not exist in FileWorker::addFromClosure()");
        }

        $this->{$variable} = $value;
    }

    public function addOptions(array $options) {
        $this->options = $options;

        return $this;
    }

    public function search() {
        $searchWorker = new FileSearchWorker($this->options);

        while( ($buffer = fgets($this->handle)) !== false ) {
            if( $searchWorker->isMainTag($buffer) ) {
                $searchWorker->mark();
                continue;
            }

            if( $searchWorker->isMarked() ) {
                if( $searchWorker->isTag($buffer) ) {
                    $searchWorker->saveValue();
                    $searchWorker->unmark();
                    continue;
                }
            }
        }

        $this->result = $searchWorker->getResult();

        return $this;
    }

    public function getResult() {
        return $this->result;
    }
} 