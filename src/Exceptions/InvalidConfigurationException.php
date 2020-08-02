<?php

namespace Zorb\Onway\Exceptions;

use Illuminate\Database\Eloquent\Model;
use Zorb\Onway\Contracts\Delivery;
use Exception;

class InvalidConfigurationException extends Exception
{
    public static function modelIsNotValid(string $className)
    {
        return new static("The given model class `$className` does not implement `".Delivery::class.'` or it does not extend `'.Model::class.'`');
    }
}
