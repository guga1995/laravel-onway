<?php
 
namespace Zorb\Onway\Events;
 
use Illuminate\Foundation\Events\Dispatchable;
use Zorb\Onway\Responses\CreateOrderResponse;

class OnCreateOrderResponse
{
    use Dispatchable;

    public $createOrderResponse;
 
    public function __construct(CreateOrderResponse $createOrderResponse)
    {
        $this->createOrderResponse = $createOrderResponse;
    }
}