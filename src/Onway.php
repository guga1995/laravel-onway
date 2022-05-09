<?php

namespace Zorb\Onway;

use Zorb\Onway\Responses\OrderDetailsResponse;
use Zorb\Onway\Responses\CreateOrderResponse;
use Zorb\Onway\Responses\OrderListResponse;
use Zorb\Onway\Responses\ErrorResponse;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Config;
use Zorb\Onway\Models\Tracking;
use Zorb\Onway\Models\Filter;
use Zorb\Onway\Models\Order;
use GuzzleHttp\Client;

class Onway
{
	/**
	 * @return CreateOrderResponse|ErrorResponse
	 */
	public function createOrder(Order $order)
	{
		$response = $this->sendRequest('order/add', $order->toArray(), true);

		if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
			return new CreateOrderResponse($response);
		}

		return new ErrorResponse($response);
	}

	/**
	 * @return OrderDetailsResponse|ErrorResponse
	 */
	public function orderDetails(Tracking $tracking)
	{
		$response = $this->sendRequest('order/info', $tracking->toArray());

		if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
			return new OrderDetailsResponse($response);
		}

		return new ErrorResponse($response);
	}

	/**
	 * @return OrderListResponse|ErrorResponse
	 */
	public function orderList(Filter $filter)
	{
		$response = $this->sendRequest('order/orders', $filter->toArray());

		if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
			return new OrderListResponse($response);
		}

		return new ErrorResponse($response);
	}

	/**
	 * @param string $url
	 * @param array $data
	 * @param bool $base
	 * @return ResponseInterface
	 */
	protected function sendRequest(string $url, array $data, bool $base = false): ResponseInterface
	{
		$client = new Client();
		$api_url = $base ? Config::get('onway.base_api_url') : Config::get('onway.delivery_api_url');

		return $client->post($api_url . '?route=api/' . $url, [
			'json' => $data,
			'debug' => Config::get('onway.debug'),
			'headers' => [
				'Accept' => 'application/json',
			],
		]);
	}
}
