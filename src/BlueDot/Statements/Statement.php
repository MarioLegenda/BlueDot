<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 10:57
 */

namespace BlueDot\Statements;

use BlueDot\Statements\StatementExceptions\InternalStatementException;

abstract class Statement
{
    protected $statementTokens = array(
        'statement-type' => false,
        'tags' => false
    );

    public function __construct($mainStatement, array $tags) {
        $validStatements = array('select', 'insert', 'update', 'delete');
        if( in_array($mainStatement, $validStatements) === false ) {
            throw new InternalStatementException("Internal Error. Select statement not initialized properly. Expected SELECT, INSERT, UPDATE or DELETE got " . $mainStatement);
        }

        $this->statementTokens['statement-type'] = $mainStatement;
        $this->statementTokens['tags'] = $tags;
    }

    public function getStatementType() {
        return $this->statementTokens['statement-type'];
    }

    public function getStatementTags() {
        return $this->statementTokens['tags'];
    }
} 