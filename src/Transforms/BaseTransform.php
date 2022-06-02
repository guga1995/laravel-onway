<?php

namespace Zorb\Onway\Transforms;

class BaseTransform
{
	protected $attributes;

	public function __construct(array $attributes)
	{
		$this->attributes = $attributes;
	}

	public function transform(): array
	{
		return $this->attributes;
	}
}
