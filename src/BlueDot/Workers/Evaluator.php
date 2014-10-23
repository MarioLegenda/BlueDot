<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 12:49
 */

namespace BlueDot\Workers;


use BlueDot\Config\Config;
use BlueDot\Workers\Interfaces\EvaluatorInterface;

class Evaluator implements EvaluatorInterface
{
    private $config;

    CONST FILE_WORKER = 1;
    CONST OBJECT_WORKER = 2;

    public function __construct(\SplFileInfo $fileInfo) {
        $this->fileInfo = $fileInfo;
    }

    public function evaluate() {
        $size = filesize($this->fileInfo->getLinkTarget());

        return Evaluator::FILE_WORKER;

        /*if( $size < 10000000 ) {
            return Evaluator::OBJECT_WORKER;
        } else if( $size > 10000000 ) {
            return Evaluator::FILE_WORKER;
        }*/
    }
} 