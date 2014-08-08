<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 17:49
 */

namespace BlueDot\SyntaxEvaluator;

use BlueDot\Statements\StatementExceptions\InternalStatementException;

class Token
{
    protected $statementTokens = array(
        'statement-type' => false,
        'tags' => false
    );

    public function __construct(array $tokens) {
        $mainStatement = $tokens['statement-type'];
        $tags = $tokens['tags'];

        $validStatements = array('select', 'insert', 'update', 'delete');
        if( in_array($mainStatement, $validStatements) === false ) {
            throw new InternalStatementException("Internal Error. Select statement not initialized properly. Expected SELECT, INSERT, UPDATE or DELETE got " . $mainStatement);
        }

        $this->statementTokens['statement-type'] = $mainStatement;
        $this->statementTokens['tags'] = $tags;
    }

    public function getMainStatement() {
        return $this->statementTokens['statement-type'];
    }

    public function getTags() {
        return $this->statementTokens['tags'];
    }
} 