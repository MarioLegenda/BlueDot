<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */


namespace BlueDot\Workers\Interfaces;

/**
 * Defines the the way dependencies are resolved
 *
 * @see
 */

interface ClosureDependencyInterface
{
    function addFromClosure($variable, $value);
} 