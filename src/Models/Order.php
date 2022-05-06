<?php

namespace Zorb\Onway\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Zorb\Onway\Enums\PaymentMethod;
use Zorb\Onway\Enums\ServiceLevel;
use Zorb\Onway\Enums\Payer;

class Order
{
	/**
	 * @var string
	 */
	private $_fromCity;

	/**
	 * @var string
	 */
	private $_fromName;

	/**
	 * @var string
	 */
	private $_fromPhone;

	/**
	 * @var string
	 */
	private $_fromAddress;

	/**
	 * @var string
	 */
	private $_fromCompany;

	/**
	 * @var string
	 */
	private $_toCity;

	/**
	 * @var string
	 */
	private $_toName;

	/**
	 * @var string
	 */
	private $_toPhone;

	/**
	 * @var string
	 */
	private $_toAddress;

	/**
	 * @var string
	 */
	private $_toCompany;

	/**
	 * @var array
	 */
	private $_services = [];

	/**
	 * @var int
	 */
	private $_parcel = 0;

	/**
	 * @var PaymentMethod
	 */
	private $_payment;

	/**
	 * @var Payer
	 */
	private $_payer;

	/**
	 * @var float
	 */
	private $_orderPrice = 0;

	/**
	 * @var float
	 */
	private $_weight = 1;

	/**
	 * @var int
	 */
	private $_quantity = 1;

	/**
	 * @var ServiceLevel
	 */
	private $_serviceLevel = ServiceLevel::Standard;

	/**
	 * @var string
	 */
	private $_orderNumber;

	/**
	 * @var string
	 */
	private $_orderDetail;

	/**
	 * @var float
	 */
	private $_invoiceAmount;

	/**
	 * @var int
	 */
	private $_brittle;

	/**
	 * @var int
	 */
	private $_receiverShippricePay = 0;

	/**
	 * @var string
	 */
	private $_additionalInformation;

	/**
	 * @param $fromCity
	 * @return $this
	 */
	public function fromCity($fromCity): self
	{
		$this->_fromCity = $fromCity;
		return $this;
	}

	/**
	 * @param $fromName
	 * @return $this
	 */
	public function fromName($fromName): self
	{
		$this->_fromName = $fromName;
		return $this;
	}

	/**
	 * @param $fromPhone
	 * @return $this
	 */
	public function fromPhone($fromPhone): self
	{
		$this->_fromPhone = $fromPhone;
		return $this;
	}

	/**
	 * @param $fromAddress
	 * @return $this
	 */
	public function fromAddress($fromAddress): self
	{
		$this->_fromAddress = $fromAddress;
		return $this;
	}

	/**
	 * @param $fromCompany
	 * @return $this
	 */
	public function fromCompany($fromCompany): self
	{
		$this->_fromCompany = $fromCompany;
		return $this;
	}

	/**
	 * @param $toCity
	 * @return $this
	 */
	public function toCity($toCity): self
	{
		$this->_toCity = $toCity;
		return $this;
	}

	/**
	 * @param $toName
	 * @return $this
	 */
	public function toName($toName): self
	{
		$this->_toName = $toName;
		return $this;
	}

	/**
	 * @param $toPhone
	 * @return $this
	 */
	public function toPhone($toPhone): self
	{
		$this->_toPhone = $toPhone;
		return $this;
	}

	/**
	 * @param $toAddress
	 * @return $this
	 */
	public function toAddress($toAddress): self
	{
		$this->_toAddress = $toAddress;
		return $this;
	}

	/**
	 * @param $toCompany
	 * @return $this
	 */
	public function toCompany($toCompany): self
	{
		$this->_toCompany = $toCompany;
		return $this;
	}

	/**
	 * @param $services
	 * @return $this
	 */
	public function services($services): self
	{
		$this->_services = $services;
		return $this;
	}

	/**
	 * @param $parcel
	 * @return $this
	 */
	public function parcel($parcel): self
	{
		$this->_parcel = $parcel;
		return $this;
	}

	/**
	 * @param $payment
	 * @return $this
	 */
	public function payment($payment): self
	{
		$this->_payment = $payment;
		return $this;
	}

	/**
	 * @param $payer
	 * @return $this
	 */
	public function payer($payer): self
	{
		$this->_payer = $payer;
		return $this;
	}

	/**
	 * @param $orderPrice
	 * @return $this
	 */
	public function orderPrice($orderPrice): self
	{
		$this->_orderPrice = $orderPrice;
		return $this;
	}

	/**
	 * @param $weight
	 * @return $this
	 */
	public function weight($weight): self
	{
		$this->_weight = $weight;
		return $this;
	}

	/**
	 * @param $quantity
	 * @return $this
	 */
	public function quantity($quantity): self
	{
		$this->_quantity = $quantity;
		return $this;
	}

	/**
	 * @param $serviceLevel
	 * @return $this
	 */
	public function serviceLevel($serviceLevel): self
	{
		$this->_serviceLevel = $serviceLevel;
		return $this;
	}

	/**
	 * @param $orderNumber
	 * @return $this
	 */
	public function orderNumber($orderNumber): self
	{
		$this->_orderNumber = $orderNumber;
		return $this;
	}

	/**
	 * @param $orderDetail
	 * @return $this
	 */
	public function orderDetail($orderDetail): self
	{
		$this->_orderDetail = $orderDetail;
		return $this;
	}

	/**
	 * @param $invoiceAmount
	 * @return $this
	 */
	public function invoiceAmount($invoiceAmount): self
	{
		$this->_invoiceAmount = $invoiceAmount;
		return $this;
	}

	/**
	 * @param $brittle
	 * @return $this
	 */
	public function brittle($brittle)
	{
		$this->_brittle = $brittle;
		return $this;
	}

	/**
	 * @param $receiverShippricePay
	 * @return $this
	 */
	public function receiverShippricePay($receiverShippricePay): self
	{
		$this->_receiverShippricePay = $receiverShippricePay;
		return $this;
	}

	/**
	 * @param $additionalInformation
	 * @return $this
	 */
	public function additionalInformation($additionalInformation): self
	{
		$this->_additionalInformation = $additionalInformation;
		return $this;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		$result = [
			'username' => Config::get('onway.username'),
			'key' => Config::get('onway.key'),
			'fromCity' => $this->_fromCity,
			'fromName' => $this->_fromName,
			'fromPhone' => $this->_fromPhone,
			'fromAddress' => $this->_fromAddress,
			'fromCompany' => $this->_fromCompany,
			'toCity' => $this->_toCity,
			'toName' => $this->_toName,
			'toPhone' => $this->_toPhone,
			'toAddress' => $this->_toAddress,
			'toCompany' => $this->_toCompany,
			'services' => $this->_services,
			'parcel' => $this->_parcel,
			'payment' => $this->_payment,
			'payer' => $this->_payer,
			'orderPrice' => $this->_orderPrice,
			'weight' => $this->_weight,
			'quantity' => $this->_quantity,
			'serviceLevel' => $this->_serviceLevel,
			'orderNumber' => $this->_orderNumber,
			'orderDetail' => $this->_orderDetail,
			'invoiceAmount' => $this->_invoiceAmount,
			'brittle' => $this->_brittle,
			'receiverShippricePay' => $this->_receiverShippricePay,
			'additionalInformation' => $this->_additionalInformation,
		];

		if (Config::get('onway.debug')) {
			Log::debug('Order@toArray', $result);
		}

		return array_filter($result, function ($key, $value) {
			return !is_null($value);
		}, ARRAY_FILTER_USE_BOTH);
	}
}