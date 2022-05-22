<?php

namespace Zorb\Onway\Responses;

class OrderDetailsResponse extends BaseResponse
{
	public function status()
	{
		return $this->attributes['status'];
	}

	public function images(): array
	{
		return $this->attributes['images'];
	}
}
