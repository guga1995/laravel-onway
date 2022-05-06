<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;

class OrderDetailsResponse
{
	/**
	 * @var ResponseInterface|null
	 */
	protected $_response;

	/**
	 * @param ResponseInterface $response
	 */
	public function __construct(ResponseInterface $response)
	{
		$this->setResponse($response);
	}

	/**
	 * @param ResponseInterface $response
	 * @return $this
	 */
	public function setResponse(ResponseInterface $response): self
	{
		$this->_response = $response;
		return $this;
	}

	/**
	 * @return ResponseInterface|null
	 */
	public function getResponse(): ?ResponseInterface
	{
		return $this->_response;
	}
}
