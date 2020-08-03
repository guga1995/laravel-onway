<?php

namespace Zorb\Onway\Facades;

use Illuminate\Support\Facades\Facade;
use Zorb\Onway\Onway as OnwayService;

class Onway extends Facade
{
    //
    protected static function getFacadeAccessor()
    {
        return OnwayService::class;
    }
}
