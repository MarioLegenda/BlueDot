<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

namespace BlueDot\Workers\Factory;


use BlueDot\Workers\Evaluator;
use BlueDot\Workers\FileWorker;


/**
 * FluentInterface pattern that instantiates all the necessary object for searching the XML file.
 *
 * Final result is an StatementResult object or null
 *
 * @see BlueDot\Workers\FileWorker
 * @see BlueDot\Workers\Interfaces\ClosureDependencyInterface
 */

class Factory
{
    /**
     * Evaluator evaluates what object to build and return the appropriatte constant. Based on that constant, this object
     *
     * Dependencies are resolved to the Worker via ClosureDependencyInterface.
     *
     * @see BlueDot\Workers\Interfaces\ClosureDependencyInterface
     *
     * @param Evaluator $evaluator
     * @param callable $dependencyClosure
     * @return FileWorker
     */
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