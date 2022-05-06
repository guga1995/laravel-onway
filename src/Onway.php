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
		$response = $this->sendRequest('order/add', $order->toArray());

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
	 * @return ResponseInterface
	 */
	protected function sendRequest(string $url, array $data): ResponseInterface
	{
		$client = new Client();

		return $client->post(Config::get('onway.api_url') . '?route=api/' . $url, [
			'json' => $data,
			'debug' => Config::get('onway.debug'),
			'headers' => [
				'Accept' => 'application/json',
			],
		]);
	}
}
