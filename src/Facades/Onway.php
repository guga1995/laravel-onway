<?php

namespace Zorb\Onway\Facades;

use Illuminate\Support\Facades\Facade;
use Zorb\Onway\Onway as OnwayService;
use Zorb\Onway\Requests\CreateOrderRequest;
use Zorb\Onway\Requests\OrderDetailsRequest;
use Zorb\Onway\Requests\OrderListRequest;

/**
 * @method static CreateOrderRequest createOrder()
 * @method static OrderDetailsRequest orderDetails()
 * @method static OrderListRequest orderList()
 *
 * @see OnwayService
 */
class Onway extends Facade
{
    //
    protected static function getFacadeAccessor()
    {
        return OnwayService::class;
    }
}
