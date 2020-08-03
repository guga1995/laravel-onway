<?php

namespace Zorb\Onway;

use Illuminate\Support\Facades\Facade;

class OnwayFacade extends Facade
{
    //
    protected static function getFacadeAccessor()
    {
        return Onway::class;
    }
}
