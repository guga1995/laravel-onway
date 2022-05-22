<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;

class BaseResponse
{
	protected $response;

	protected $attributes;

	public function __construct(ResponseInterface $response)
	{
		$this->response = $response;
		$this->attributes = json_decode((string)$response->getBody(), true);
	}

	public function getResponse(): ?ResponseInterface
	{
		return $this->response;
	}

	public function getAttributes(): array
	{
		return $this->attributes;
	}
}
