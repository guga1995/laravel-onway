<?php

namespace Zorb\Onway\Requests;

use Zorb\Onway\Events\OnResponse;
use Zorb\Onway\Responses\CreateOrderResponse;

/**
 * @method CreateOrderResponse send()
 */
class GetCitiesRequest extends BaseRequest
{
	public function getUrl(): string
	{
		return 'order/regions';
	}

	public function getEventClass(): string
	{
		return OnResponse::class;
	}
}