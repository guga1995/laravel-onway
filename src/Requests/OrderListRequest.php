<?php

namespace Zorb\Onway\Requests;

use Zorb\Onway\Events\OnOrderListResponse;
use Zorb\Onway\Responses\OrderListResponse;

/**
 * @method OrderListResponse send()
 */
class OrderListRequest extends BaseRequest
{
	protected function defaults()
	{
		return [
			'page' => 1,
			'limit' => 20,
		];
	}

	public function getUrl(): string
	{
		return 'order/orders';
	}

	public function getResponseClass(): string
	{
		return OrderListResponse::class;
	}

	public function getEventClass(): string
	{
		return OnOrderListResponse::class;
	}

	public function toArray(): array
	{
		return [
			'page' => $this->attributes['page'],
			'limit' => $this->attributes['limit'],
			// 'filters' => [
			// 	'from_date' => $this->attributes['from_date'],
			// 	'to_date' => $this->attributes['to_date']
			// ]
		];
	}

	public function fromDate($value): self
	{
		$this->attributes['from_date'] = $value;
		return $this;
	}

	public function toDate($value): self
	{
		$this->attributes['to_date'] = $value;
		return $this;
	}

	public function page($value): self
	{
		$this->attributes['page'] = $value;
		return $this;
	}

	public function limit($value): self
	{
		$this->attributes['limit'] = $value;
		return $this;
	}
}