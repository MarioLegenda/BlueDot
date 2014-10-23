<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 13:25
 */

namespace BlueDot\Workers\Interfaces;


interface ClosureDependencyInterface
{
    function addFromClosure($variable, $value);
} 