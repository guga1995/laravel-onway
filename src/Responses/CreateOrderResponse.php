<?php

namespace Zorb\Onway\Responses;

class CreateOrderResponse extends BaseResponse
{
	protected function transform($attributes): array
	{
		return [
			"tracking_number" => $attributes["trackingnumber"]
		];
	}
}
