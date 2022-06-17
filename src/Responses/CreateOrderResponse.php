<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;
use Zorb\Onway\Models\OnwayOrder;
use Zorb\Onway\Transforms\BaseTransform;
use Zorb\Onway\Transforms\CreateOrderTransform;

class CreateOrderResponse extends BaseResponse
{
	private $requestData;

	public function __construct(ResponseInterface $response, array $requestData)
	{
		$this->requestData = $requestData;
		parent::__construct($response);
	}

	protected function makeTransformInstance(array $data): BaseTransform
	{
		return new CreateOrderTransform([
			'data' => $data, 
			'request_data' => $this->requestData
		]);
	}

	public function createOrUpdateModel()
	{
		return OnwayOrder::query()->updateOrCreate([
			'tracking_number' => $this->tracking_number
		], $this->toArray());
	}
}
