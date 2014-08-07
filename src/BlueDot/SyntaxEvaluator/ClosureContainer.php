<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:18
 */

namespace BlueDot\SyntaxEvaluator;


class ClosureContainer
{
    private $closures = array();

    public function __construct() {

    }

    public function addClosure($key, \Closure $closure) {
        $this->closures[$key] = $closure;
    }

    public function closureExists($key) {
        if ( ! array_key_exists($key, $this->closures ) OR ! $this->closures[$key] instanceof \Closure ) {
            return false;
        }

        return true;
    }

    public function getClosure($key) {
        if( $this->closureExists($key) === true ) {
            return $this->closures[$key];
        }

        return false;
    }
} 