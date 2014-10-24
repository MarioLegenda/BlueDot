<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @api
 *
 */


namespace BlueDot;

use BlueDot\Cache\Cache;
use BlueDot\Cache\ConfigCache;
use BlueDot\Cache\ValuesCache;
use BlueDot\Config\Config;
use BlueDot\Config\Exception\ConfigException;
use BlueDot\Statement\Select;

/**
 * BlueDot public client code interface
 *
 * Description:
 * BlueDot searches for the desired value by knowing the parent tag name ( $mainTag ) and the desired tag name ( $tagName ) who's value
 * we want. $tagName is injected trough Select::select($tagName) and $mainTag is injected trough Select::from($mainTag). It then
 * traverses trough the xml file via fgets(), line by line and searches for the value inside $tagName tag with regular expressions. After the
 * value was found, it returns StatementResult object in an array with the desired values.
 *
 * It is important to say that onse BlueDot::select() is called, client code is no longer working the BlueDot object but with Select
 * object who is chainable
 *
 * @api
 * @see BlueDot\Config\Config
 * @see BlueDot\Statement\Select
 */


class BlueDot
{
    private static $config = null;

    public static function config(Config $config) {
        self::$config = $config;
    }

    public static function select($tagName) {
        if( self::$config === null ) {
            throw new ConfigException('Config is not set. Call BlueDot::config(Config $config) first');
        }

        $select = new Select(self::$config);
        return $select->select($tagName);
    }
} 