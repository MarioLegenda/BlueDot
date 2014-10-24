<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

namespace BlueDot\Statement;

/**
 * Searches for keys in an array
 */

class StatementResult
{
    /**
     * @var array
     */
    private $result = array();

    /**
     * @param array $results
     */
    public function __construct(array $results) {
        $this->result = $results;
    }

    /**
     * @param string $key
     * @return string
     */

    public function get($key) {
        if( ! array_key_exists($key, $this->result) ) {
            return null;
        }

        return $this->result[$key];
    }

    /**
     * @param string $key
     * @return bool
     */

    public function exists($key) {
        if( ! array_key_exists($key, $this->result) ) {
            return false;
        }

        return true;
    }
} 