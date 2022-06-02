<?php

namespace Zorb\Onway\Transforms;

class CreateOrderTransform extends BaseTransform
{
	public function transform(): array
	{
		return [
			"tracking_number" => $this->attributes["trackingnumber"]
		];
	}
}
