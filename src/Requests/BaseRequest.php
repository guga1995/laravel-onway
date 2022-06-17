<?php

namespace Zorb\Onway\Requests;

use Zorb\Onway\Exceptions\OnwayResponseException;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Zorb\Onway\Responses\BaseResponse;

abstract class BaseRequest
{
	protected array $attributes;

	public function __construct()
	{
		$this->attributes = $this->defaults();
	}

	protected function defaults()
	{
		return [];
	}

	public function send()
	{
		$url = $this->getUrl();
		$data = $this->toRequestBody();

		$client = new Client();
		$api_url = Config::get('onway.base_api_url');

		$fullUrl = $api_url . '?route=api/' . $url;

		try {
			$response = $client->post($fullUrl, [
				'json' => $data,
				'headers' => [
					'Accept' => 'application/json',
				],
			]);
		} finally {
			$debugEnable = Config::get('onway.debug.enable');
			$debugChannel = Config::get('onway.debug.channel');

			$responseBody = json_decode((string)$response->getBody(), true);

			if ($debugEnable) {
				Log::channel($debugChannel)
					->debug('onway_debug', [
						'url' => $fullUrl,
						'request' => $data,
						'response' => $responseBody
					]);
			}
		}

		if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {

			$this->handleException($response, $responseBody);

			$eventClass = $this->getEventClass();

			$responseInstance = $this->makeResponseInstance($response);

			event(new $eventClass($responseInstance));

			return $responseInstance;
		}

		throw new OnwayResponseException($response);
	}

	public function toArray(): array
	{
		return $this->attributes;
	}

	public function toRequestBody()
	{
		return array_merge([
			'username' => Config::get('onway.username'),
			'key' => Config::get('onway.key'),
		], $this->toArray());
	}

	protected function makeResponseInstance(ResponseInterface $response)
	{
		$responseClass = $this->getResponseClass();
		return new $responseClass($response);
	}

	protected function getResponseClass(): string
	{
		return BaseResponse::class;
	}

	protected function handleException($response, array $body)
	{
		if (Arr::has($body, 'error')) {
			throw new OnwayResponseException($response, Arr::get($body, 'error'));
		}
	}

	abstract public function getUrl(): string;

	abstract public function getEventClass(): string;
}
