<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 10:57
 */

namespace BlueDot\Statements;

use BlueDot\SyntaxEvaluator\Token;

abstract class Statement
{

    protected $token;

    public function __construct(Token $token) {
        $this->token = $token;
    }
} 