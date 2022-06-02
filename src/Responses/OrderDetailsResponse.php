<?php

namespace Zorb\Onway\Responses;

use Illuminate\Support\Carbon;
use Zorb\Onway\Enums\OrderStatusId;
use Zorb\Onway\Models\OnwayOrder;
use Zorb\Onway\Transforms\OrderDetailsTransform;

class OrderDetailsResponse extends BaseResponse
{
	protected function getTransformClass()
	{
		return OrderDetailsTransform::class;
	}

	public function createOrUpdateModel()
	{
		return OnwayOrder::query()->updateOrCreate([
			'tracking_number' => $this->tracking_number
		], $this->toArray());
	}
}
