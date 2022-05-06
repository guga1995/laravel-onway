<?php

namespace Zorb\Onway;

use Zorb\Onway\Responses\OrderDetailsResponse;
use Zorb\Onway\Responses\CreateOrderResponse;
use Zorb\Onway\Responses\OrderListResponse;
use Zorb\Onway\Responses\ErrorResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Zorb\Onway\Models\Tracking;
use Zorb\Onway\Models\Filter;
use Zorb\Onway\Models\Order;

class Onway
{
	/**
	 * @return CreateOrderResponse|ErrorResponse
	 */
	public function createOrder(Order $order)
	{
		$response = Http::post('?route=api/order/add', $order->toArray())
			->withOptions(['debug' => Config::get('onway.debug')])
			->baseUrl(Config::get('onway.api_url'))
			->acceptJson();

		if ($response->ok()) {
			return new CreateOrderResponse($response);
		}

		return new ErrorResponse($response);
	}

	/**
	 * @return OrderDetailsResponse|ErrorResponse
	 */
	public function orderDetails(Tracking $tracking)
	{
		$response = Http::post('?route=api/order/info', $tracking->toArray())
			->withOptions(['debug' => Config::get('onway.debug')])
			->baseUrl(Config::get('onway.api_url'))
			->acceptJson();

		if ($response->ok()) {
			return new OrderDetailsResponse($response);
		}

		return new ErrorResponse($response);
	}

	/**
	 * @return OrderListResponse|ErrorResponse
	 */
	public function orderList(Filter $filter)
	{
		$response = Http::post('?route=api/order/orders', $filter->toArray())
			->withOptions(['debug' => Config::get('onway.debug')])
			->baseUrl(Config::get('onway.api_url'))
			->acceptJson();

		if ($response->ok()) {
			return new OrderListResponse($response);
		}

		return new ErrorResponse($response);
	}
}
