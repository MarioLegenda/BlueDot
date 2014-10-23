<?php

namespace BlueDot;

use BlueDot\Config\Config;
use BlueDot\Statement\Select;

class BlueDot
{
    private $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function select($tagName) {
        $select = new Select($this->config);
        return $select->select($tagName);
    }
} 