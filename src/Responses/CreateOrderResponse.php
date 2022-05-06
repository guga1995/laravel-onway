<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;

class CreateOrderResponse
{
	/**
	 * @var string|null
	 */
	protected $_trackingNumber;

	/**
	 * @param ResponseInterface $response
	 */
	public function __construct(ResponseInterface $response)
	{
		$responseJson = json_decode((string)$response->getBody(), true);

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
