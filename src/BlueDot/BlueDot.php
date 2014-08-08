<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 11:16
 */

namespace BlueDot;

use BlueDot\Processor\Processor;
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

    public function __construct($xmlFilePath) {
        $this->xmlFilePath = $xmlFilePath;
        $this->syntaxEvaluator = new SyntaxEvaluator();
    }

    public function prepare($sqlQuery) {
        try {
            $syntaxEval = $this->syntaxEvaluator->evaluate($sqlQuery);
            $statement = $syntaxEval->__invoke($sqlQuery);

            $processor = new Processor($this->xmlFilePath);
            $processor->run();

            $statement->addProcessor($processor);
            return $statement;
        }
        catch( IncorrectSyntaxException $e ) {
            echo $e->getMessage();
            die();
        }
        catch( InternalStatementException $e ) {
            echo "An error has been sent to error.log in the BlueDot <b style='color:#C90000'>root</b><br>
            <b style='color:#C90000'>BlueDot terminated...</b>";
        }
    }
} 