<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:09
 */

namespace BlueDot\SyntaxEvaluator;

use BlueDot\SyntaxEvaluator\SyntaxExceptions\IncorrectSyntaxException;

class SyntaxEvaluator extends AbstractEvaluator
{
    private $match;
    private $sqlQuery;

    public function __construct() {
        parent::__construct();
    }

    public function evaluate($sqlQuery) {
        $this->sqlQuery = $sqlQuery;
        preg_match('#^(\w+)#', $sqlQuery, $matches);

        $this->match = strtolower($matches[1]);

        if( $this->closureContainer->closureExists($this->match) === true ) {
            $anonymousEval = $this->closureContainer->getClosure($this->match);
            return $anonymousEval;
        }

        $sytaxError = new SyntaxError();
        $sytaxError->addError('unknown-order', "Unknown statement <b style='color:#C90000'>" . $this->match . "</b> in <b style='color:#4580FF'>" . $this->sqlQuery . "</b>");
        throw new IncorrectSyntaxException($sytaxError);
    }
} 