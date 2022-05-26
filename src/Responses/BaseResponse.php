<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;
use stdClass;

class BaseResponse
{
	protected $response;

	protected $attributes;

	protected $attributesStd;

	public function __construct(ResponseInterface $response)
	{
		$this->response = $response;

		$data = json_decode((string)$response->getBody(), true);

		$attributes = $this->transform($data);

		$this->attributes = $attributes;

		$this->attributesStd = json_decode(json_encode($attributes));
	}

	public function getResponse(): ?ResponseInterface
	{
		return $this->response;
	}

	public function getAttributes(): array
	{
		return $this->attributes;
	}

	public function getAttributesStd(): stdClass
	{
		return $this->attributesStd;
	}

	protected function transform($attributes): array
	{
		return $attributes;
	}

	public function __get(string $name) 
	{
		return $this->attributesStd->{$name};
	}
}
