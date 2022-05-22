<?php

namespace Zorb\Onway\Requests;

use Zorb\Onway\Events\OnOrderDetailsResponse;
use Zorb\Onway\Responses\OrderDetailsResponse;

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