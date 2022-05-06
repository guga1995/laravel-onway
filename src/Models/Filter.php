<?php

namespace Zorb\Onway\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class Filter
{
	/**
	 * @var Carbon
	 */
	public $_fromDate;

	/**
	 * @var Carbon
	 */
	public $_toDate;

	/**
	 * @var int
	 */
	public $_page = 1;

	/**
	 * @var int
	 */
	public $_limit = 20;

	/**
	 * @param $fromDate
	 * @return $this
	 */
	public function fromDate($fromDate): self
	{
		$this->_fromDate = $fromDate;
		return $this;
	}

	/**
	 * @param $toDate
	 * @return $this
	 */
	public function toDate($toDate): self
	{
		$this->_toDate = $toDate;
		return $this;
	}

	/**
	 * @param $page
	 * @return $this
	 */
	public function page($page): self
	{
		$this->_page = $page;
		return $this;
	}

	/**
	 * @param $limit
	 * @return $this
	 */
	public function limit($limit): self
	{
		$this->_limit = $limit;
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
		$filters = array_filter([
			'from_date' => $this->_fromDate,
			'to_date' => $this->_toDate,
		], function ($key, $value) {
			return !is_null($value);
		}, ARRAY_FILTER_USE_BOTH);

		$result = [
			'username' => Config::get('onway.username'),
			'key' => Config::get('onway.key'),
			'filters' => $filters,
			'page' => $this->_page,
			'limit' => $this->_limit,
		];

		if (Config::get('onway.debug')) {
			Log::debug('Filter@toArray', $result);
		}

		return array_filter($result, function ($key, $value) {
			return !is_null($value);
		}, ARRAY_FILTER_USE_BOTH);
	}
}