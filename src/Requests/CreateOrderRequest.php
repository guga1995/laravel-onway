<?php

namespace Zorb\Onway\Requests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Zorb\Onway\Enums\OrderService;
use Zorb\Onway\Enums\ServiceLevel;
use Zorb\Onway\Events\OnCreateOrderResponse;
use Zorb\Onway\Exceptions\OnwayResponseException;
use Zorb\Onway\Responses\CreateOrderResponse;

/**
 * @method CreateOrderResponse send()
 */
class CreateOrderRequest extends BaseRequest
{
	protected function defaults()
	{
		return [
			'services' => [OrderService::Picturing],
			'parcel' => 0,
			'order_price' => 0,
			'weight' => 1,
			'quantity' => 1,
			'service_level' => ServiceLevel::Standard,
			'receiver_shipprice_pay' => 0,
		];
	}

	public function getUrl(): string
	{
		return 'order/add';
	}

	public function getResponseClass(): string
	{
		return CreateOrderResponse::class;
	}

	public function getEventClass(): string
	{
		return OnCreateOrderResponse::class;
	}

	public function fromCity($value): self
	{
		$this->attributes['from_city'] = $value;
		return $this;
	}

	public function fromName($value): self
	{
		$this->attributes['from_name'] = $value;
		return $this;
	}

	public function fromPhone($value): self
	{
		$this->attributes['from_phone'] = $value;
		return $this;
	}

	public function fromAddress($value): self
	{
		$this->attributes['from_address'] = $value;
		return $this;
	}

	public function fromCompany($value): self
	{
		$this->attributes['from_company'] = $value;
		return $this;
	}

	public function toCity($value): self
	{
		$this->attributes['to_city'] = $value;
		return $this;
	}

	public function toName($value): self
	{
		$this->attributes['to_name'] = $value;
		return $this;
	}

	public function toPhone($value): self
	{
		$this->attributes['to_phone'] = $value;
		return $this;
	}

	public function toAddress($value): self
	{
		$this->attributes['to_address'] = $value;
		return $this;
	}

	public function toCompany($value): self
	{
		$this->attributes['to_company'] = $value;
		return $this;
	}

	public function services($value): self
	{
		$this->attributes['services'] = $value;
		return $this;
	}

	public function parcel($value): self
	{
		$this->attributes['parcel'] = $value;
		return $this;
	}

	public function payment($value): self
	{
		$this->attributes['payment'] = $value;
		return $this;
	}

	public function payer($value): self
	{
		$this->attributes['payer'] = $value;
		return $this;
	}

	public function orderPrice($value): self
	{
		$this->attributes['order_price'] = $value;
		return $this;
	}

	public function weight($value): self
	{
		$this->attributes['weight'] = $value;
		return $this;
	}

	public function quantity($value): self
	{
		$this->attributes['quantity'] = $value;
		return $this;
	}

	public function serviceLevel($value): self
	{
		$this->attributes['serviceLevel'] = $value;
		return $this;
	}

	public function orderNumber($value): self
	{
		$this->attributes['order_number'] = $value;
		return $this;
	}

	public function orderDetail($value): self
	{
		$this->attributes['order_detail'] = $value;
		return $this;
	}

	public function invoiceAmount($value): self
	{
		$this->attributes['invoice_amount'] = $value;
		return $this;
	}

	public function brittle($value)
	{
		$this->attributes['brittle'] = $value;
		return $this;
	}

	public function receiverShipricePay($value): self
	{
		$this->attributes['receiver_shiprice_pay'] = $value;
		return $this;
	}

	public function additionalInformation($value): self
	{
		$this->attributes['additional_information'] = $value;
		return $this;
	}
}