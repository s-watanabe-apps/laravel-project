<?php
namespace App\Console\Commands\SubModules;

abstract class SubModule
{
    abstract protected static function get(&$context);
}