<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:09
 */

namespace BlueDot\SyntaxEvaluator;


class SyntaxEvaluator extends AbstractEvaluator
{
    public function __construct() {
        parent::__construct();
    }

    public function evaluate($sqlSyntax) {
        preg_match('#^(\w+)#', $sqlSyntax, $matches);
        var_dump($matches);
        die();
    }

    public function isCorrectSyntax() {
    }

    public function getSyntaxToken() {

    }
} 