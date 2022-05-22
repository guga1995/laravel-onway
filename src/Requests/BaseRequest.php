<?php

namespace Zorb\Onway\Requests;

use App\Exceptions\OnwayResponseException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

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

			if ($debugEnable) {
				Log::channel($debugChannel)
					->debug('onway_debug', [
						'url' => $fullUrl,
						'request' => $data,
						'response' => json_decode((string)$response->getBody(), true)
					]);
			}
		}

		if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {

			$responseClass = $this->getResponseClass();
			$eventClass = $this->getEventClass();

			$responseInstance = new $responseClass($response);
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

	abstract public function getUrl(): string;

	abstract public function getResponseClass(): string;

	abstract public function getEventClass(): string;
}
