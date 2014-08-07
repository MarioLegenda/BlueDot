<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 11:16
 */

namespace BlueDot;

use BlueDot\SyntaxEvaluator\SyntaxEvaluator;
use BlueDot\SyntaxEvaluator\SyntaxExceptions\IncorrectSyntaxException;

class BlueDot
{

    /**
     * Pravila: Sve eksepcije hvata ovdje
     */
    private $xmlFilePath;
    private $syntaxEvaluator;

    public function __construct($xmlFilePath) {
        $this->xmlFilePath = $xmlFilePath;
        $this->syntaxEvaluator = new SyntaxEvaluator();
    }

    public function prepare($sqlQuery) {
        try {
            $this->syntaxEvaluator->evaluate($sqlQuery);
        }
        catch( IncorrectSyntaxException $e ) {
            echo $e->getMessage() . "\r\n";
            echo $e->getTraceAsString() . "\r\n";
            die();
        }
    }
} 