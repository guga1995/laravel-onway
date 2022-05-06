<?php

namespace Zorb\Onway\Responses;

use Psr\Http\Message\ResponseInterface;

class ErrorResponse
{
	/**
	 * @var string|null
	 */
	protected $_message;

	/**
	 * @param ResponseInterface $response
	 */
	public function __construct(ResponseInterface $response)
	{
		$body = (string)$response->getBody();
		$responseJson = json_decode($body, true);

		if (isset($responseJson['error'])) {
			$this->setMessage($responseJson['error']);
		} else {
			$this->setMessage($body);
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
