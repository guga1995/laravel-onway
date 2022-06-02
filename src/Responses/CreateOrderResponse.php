<?php

namespace Zorb\Onway\Responses;

use Zorb\Onway\Transforms\CreateOrderTransform;

class CreateOrderResponse extends BaseResponse
{
	protected function getTransformClass()
	{
		return CreateOrderTransform::class;
	}
}
