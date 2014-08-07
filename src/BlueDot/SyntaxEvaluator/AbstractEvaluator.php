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
    private $closureContainer;

    public function __construct() {
        $closureContainer = new ClosureContainer();

        $closureContainer->addClosure('select', function() {

        });

        $this->closureContainer = $closureContainer;
    }
} 