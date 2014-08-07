<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:18
 */

namespace BlueDot\SyntaxEvaluator;


abstract class AbstractEvaluator
{
    protected $closureContainer;

    public function __construct() {
        $closureContainer = new ClosureContainer();

        $closureContainer->addClosure('select', function() {
            if( func_num_args() == 0) {

            }
        });

        $this->closureContainer = $closureContainer;
    }
} 