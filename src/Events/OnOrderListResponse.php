<?php
 
namespace Zorb\Onway\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Zorb\Onway\Responses\OrderDetailsResponse;

class OnOrderListResponse
{
    use Dispatchable;

    public $orderDetailsResponse;
 
    public function __construct(OrderDetailsResponse $orderDetailsResponse)
    {
        $this->orderDetailsResponse = $orderDetailsResponse;
    }
}