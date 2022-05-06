<?php

namespace Zorb\Onway\Responses;

use Illuminate\Http\Client\Response;

class CreateOrderResponse extends Response
{
	/**
	 * @var string|null
	 */
	protected $_trackingNumber;

	/**
	 * @param Response $response
	 */
	public function __construct(Response $response)
	{
		parent::__construct($response->toPsrResponse());

		$responseJson = $response->json();

		if (isset($responseJson['trackingnumber'])) {
			$this->setTrackingNumber($responseJson['trackingnumber']);
		}
	}

	/**
	 * @param string $trackingNumber
	 * @return $this
	 */
	public function setTrackingNumber(string $trackingNumber): self
	{
		$this->_trackingNumber = $trackingNumber;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTrackingNumber(): ?string
	{
		return $this->_trackingNumber;
	}
}
