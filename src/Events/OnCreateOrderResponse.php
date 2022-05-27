<?php
 
namespace Zorb\Onway\Events;
 
use Illuminate\Foundation\Events\Dispatchable;
use Zorb\Onway\Responses\CreateOrderResponse;

class OnCreateOrderResponse
{
    use Dispatchable;

    public $response;
 
    public function __construct(CreateOrderResponse $response)
    {
        $this->createOrderResponse = $response;
    }
}