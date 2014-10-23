<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 12:54
 */

namespace BlueDot\Workers\Factory;


use BlueDot\Workers\Evaluator;
use BlueDot\Workers\FileWorker;

class Factory
{
    public static function createWorker(Evaluator $evaluator, \Closure $dependencyClosure = null ) {
        $evaluated = $evaluator->evaluate();
        if( $evaluated === Evaluator::FILE_WORKER ) {
            $worker = new FileWorker();

            if( $dependencyClosure !== null ) {
                $dependencyClosure->__invoke($worker);
            }

            return $worker;
        }
    }
} 