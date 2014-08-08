<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:09
 */

namespace BlueDot\SyntaxEvaluator;

use BlueDot\SyntaxEvaluator\SyntaxExceptions\IncorrectSyntaxException;
use BlueDot\Statements\Statement;

class SyntaxEvaluator extends AbstractEvaluator
{
    private $match;
    private $sqlQuery;
    private $statement;

    public function __construct() {
        parent::__construct();
    }

    public function evaluate($sqlQuery) {
        $this->sqlQuery = $sqlQuery;
        preg_match('#^(\w+)#', $sqlQuery, $matches);

        $this->match = strtolower($matches[1]);

        if( $this->closureContainer->closureExists($this->match) === true ) {
            $anonymousEval = $this->closureContainer->getClosure($this->match);

            $evaluatedQuery = $anonymousEval->__invoke($this->sqlQuery);

            if( $evaluatedQuery instanceof SyntaxError ) {
                throw new IncorrectSyntaxException($evaluatedQuery);
            }

            $this->statement = $evaluatedQuery;
            return;
        }

        $sytaxError = new SyntaxError();
        $sytaxError->addError('unknown-order', "Unknown order <b style='color:#C90000'>" . $this->match . '</b> in ' . $this->sqlQuery);
        throw new IncorrectSyntaxException($sytaxError);
    }

    public function getStatement() {
        return $this->statement;
    }
} 