<?php
 
namespace Zorb\Onway\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Zorb\Onway\Responses\OrderDetailsResponse;
use Zorb\Onway\Responses\OrderListResponse;

class OnOrderListResponse
{
    use Dispatchable;

    public $response;
 
    public function __construct(OrderListResponse $response)
    {
        $this->response = $response;
    }
}