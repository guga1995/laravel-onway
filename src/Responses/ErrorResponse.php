<?php

namespace Zorb\Onway\Responses;

use Illuminate\Http\Client\Response;

class ErrorResponse extends Response
{
	/**
	 * @var string|null
	 */
	protected $_message;

	/**
	 * @param Response $response
	 */
	public function __construct(Response $response)
	{
		parent::__construct($response->toPsrResponse());

		$responseJson = $response->json();

		if (isset($responseJson['error'])) {
			$this->setMessage($responseJson['error']);
		} else {
			$this->setMessage($response->body());
		}
	}

	/**
	 * @param string $message
	 * @return $this
	 */
	public function setMessage(string $message): self
	{
		$this->_message = $message;
		return $this;
	}

	/**
	 * @return ?string
	 */
	public function getMessage(): ?string
	{
		return $this->_message;
	}
}
