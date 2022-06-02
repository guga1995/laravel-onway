<?php

namespace Zorb\Onway\Responses;

use Illuminate\Support\Carbon;
use Zorb\Onway\Transforms\OrderListTransform;

class OrderListResponse extends BaseResponse
{
    protected function getTransformClass()
	{
		return OrderListTransform::class;
	}
}
