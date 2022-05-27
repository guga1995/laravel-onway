<?php

namespace Zorb\Onway;

use Zorb\Onway\Jobs\OnwaySync;
use Zorb\Onway\Requests\CreateOrderRequest;
use Zorb\Onway\Requests\OrderDetailsRequest;
use Zorb\Onway\Requests\OrderListRequest;

class Onway
{
	public function createOrder(): CreateOrderRequest
	{
		return new CreateOrderRequest;
	}

	public function orderDetails(): OrderDetailsRequest
	{
		return new OrderDetailsRequest;
	}

	public function orderList(): OrderListRequest
	{
		return new OrderListRequest;
	}

	public function startSync()
	{
		OnwaySync::dispatch(1, 20);
	}
}
