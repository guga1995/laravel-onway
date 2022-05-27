<?php
 
namespace Zorb\Onway\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Zorb\Onway\Responses\OrderDetailsResponse;

class OnOrderDetailsResponse
{
    use Dispatchable;

    public $response;
 
    public function __construct(OrderDetailsResponse $response)
    {
        $this->orderDetailsResponse = $response;
    }
}