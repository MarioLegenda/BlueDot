<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 11:16
 */

namespace BlueDot;

use BlueDot\SyntaxEvaluator\SyntaxEvaluator;

class BlueDot
{
    private $xmlFilePath;
    private $syntaxEvaluator;

    public function __construct($xmlFilePath) {
        $this->xmlFilePath = $xmlFilePath;
        $this->syntaxEvaluator = new SyntaxEvaluator();
    }

    public function prepare($sqlQuery) {
        $this->syntaxEvaluator->evaluate($sqlQuery);
    }
} 