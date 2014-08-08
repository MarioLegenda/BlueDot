<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.08.14.
 * Time: 14:18
 */

namespace BlueDot\SyntaxEvaluator;


use BlueDot\SyntaxEvaluator\SyntaxExceptions\IncorrectSyntaxException;
use BlueDot\Statements\SelectStatement;

abstract class AbstractEvaluator
{
    protected $closureContainer;

    public function __construct() {
        $closureContainer = new ClosureContainer();

        $closureContainer->addClosure('select', function() {
            if( func_num_args() == 0) {
                $syntaxError = new SyntaxError();
                $syntaxError->addError('closure-num-args', "Select statement closure evaluator: <b style='color:#C90000'>Invalid number of arguments</b>");
                return $syntaxError;
            }

            $sqlQuery = strtolower(func_get_arg(0));

            preg_match('#^(select)\s+\[([a-zA-Z0-9,\s]+)\]#', $sqlQuery, $matches);

            if( ! isset($matches[1]) OR ! isset($matches[2] ) ) {
                $syntaxError = new SyntaxError();

                ( ! isset($matches[0]) ) ? $syntaxError->addError('unknown-order', "<b style='color:#C90000'>Unknown order in your query.</b> 'Select query should start with a <b style='color#C90000'>SELECT</b> statement") : '';
                ( ! isset($matches[1]) ) ? $syntaxError->addError('unknown-order', "<b style='color:#C90000'>Unknown order in your query</b> 'Select' query should start with a <b style='color#C90000'>SELECT</b> statement and a list of comma separated strings enclosed in []") : '';
                return $syntaxError;
            }

            $mainStatement = $matches[1];
            $searchTags = $matches[2];

            /* Vratiti se ovdje i provjeriti da li lista traženih tagova u ispravnoj sintaksi nakon što prođem knjigu
            regularnih izraza */
            //preg_match('#([[a-zA-z]+,\s+])+#', $searchTags, $matches);

            $tags = preg_split('#,\s+#', $searchTags);

            $selectStatement = new SelectStatement($mainStatement, $tags);

            return $selectStatement;
        });

        $this->closureContainer = $closureContainer;
    }
} 