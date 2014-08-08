<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 10:57
 */

namespace BlueDot\Statements;

use BlueDot\Processor\Processor;
use BlueDot\SyntaxEvaluator\Token;

class SelectStatement extends Statement
{
    private $processor;

    public function __construct(Token $token) {
        parent::__construct($token);
    }

    public function addProcessor(Processor $processor) {
        $this->processor = $processor;
    }

    public function get($tagKey) {

    }


} 