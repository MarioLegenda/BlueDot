<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 12:01
 */

namespace BlueDot\Workers\Interfaces;


interface WorkerInterface
{
    function addOptions(array $options);
    function search();
} 