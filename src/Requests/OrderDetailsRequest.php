<?php

namespace Zorb\Onway\Requests;

use Illuminate\Support\Arr;
use Zorb\Onway\Events\OnOrderDetailsResponse;
use Zorb\Onway\Exceptions\OnwayResponseException;
use Zorb\Onway\Responses\OrderDetailsResponse;

/**
 * @method OrderDetailsResponse send()
 */
class OrderDetailsRequest extends BaseRequest
{
	public function getUrl(): string
	{
		return 'order/info';
	}

	public function getResponseClass(): string
	{
		return OrderDetailsResponse::class;
	}

	public function getEventClass(): string
	{
		return OnOrderDetailsResponse::class;
	}

	public function tracking($value): self
	{
		$this->attributes['tracking'] = $value;
		return $this;
	}
}