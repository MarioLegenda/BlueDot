<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 11:16
 */

namespace BlueDot;

use BlueDot\Processor\Processor;
use BlueDot\Processor\Validator;

use BlueDot\Statements\StatementExceptions\InternalStatementException;
use BlueDot\SyntaxEvaluator\SyntaxExceptions\IncorrectSyntaxException;

use BlueDot\SyntaxEvaluator\SyntaxEvaluator;

class BlueDot
{

    /**
     * Pravila: Sve eksepcije hvata ovdje
     */
    private $xmlFilePath;
    private $syntaxEvaluator;
    private $processor;

    public function __construct($xmlFilePath) {
        $this->xmlFilePath = $xmlFilePath;
        $this->syntaxEvaluator = new SyntaxEvaluator();
        $this->processor = new Processor(new Validator($xmlFilePath));
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
        catch( InternalStatementException $e ) {
            echo "An error has been sent to error.log in the BlueDot <b style='color:#C90000'>root</b><br>
            <b style='color:#C90000'>BlueDot terminated...</b>";
        }
    }

    public function query() {

    }
} 