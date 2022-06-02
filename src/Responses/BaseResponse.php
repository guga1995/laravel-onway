<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;
use stdClass;
use Zorb\Onway\Transforms\BaseTransform;

class BaseResponse
{
	protected $response;

	protected $attributes;

	protected $attributesStd;

	public function __construct(ResponseInterface $response)
	{
		$this->response = $response;

		$data = json_decode((string)$response->getBody(), true);

		$transformClass = $this->getTransformClass();
		$transform = new $transformClass($data);
		$attributes = $transform->transform();

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

	public function toArray(): array
	{
		return $this->getAttributes();
	}

	public function getAttributesStd(): stdClass
	{
		return $this->attributesStd;
	}

	public function __get(string $name) 
	{
		return $this->attributesStd->{$name};
	}

	protected function getTransformClass()
	{
		return BaseTransform::class;
	}
}
