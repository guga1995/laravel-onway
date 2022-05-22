<?php

namespace Zorb\Onway\Responses;

class CreateOrderResponse extends BaseResponse
{
	public function trackingNumber()
	{
		return $this->attributes['trackingnumber'];
	}
}
