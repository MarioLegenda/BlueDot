<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 08.08.14.
 * Time: 10:57
 */

namespace BlueDot\Statements;


class SelectStatement extends Statement
{
    public function __construct($mainStatement, array $tags) {
        parent::__construct($mainStatement, $tags);
    }
} 