<?php

namespace Zorb\Onway\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class Tracking
{
	/**
	 * @var string
	 */
	public $_id;

	/**
	 * @param $id
	 * @return $this
	 */
	public function id($id): self
	{
		$this->_id = $id;
		return $this;
	}

	/**
	 * @return $this
	 */
	public static function make(): self
	{
		return new static();
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		$result = [
			'username' => Config::get('onway.username'),
			'key' => Config::get('onway.key'),
			'id' => $this->_id,
		];

		if (Config::get('onway.debug')) {
			Log::debug('Tracking@toArray', $result);
		}

		return array_filter($result, function ($key, $value) {
			return !is_null($value);
		}, ARRAY_FILTER_USE_BOTH);
	}
}