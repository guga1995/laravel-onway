<?php

namespace Zorb\Onway\Exceptions;

use Exception;

class OnwayResponseException extends Exception {

    private $response;
    
    public function __construct($response, string $message = "Something went wrong", int $code = 500)
    {
        $this->message = $message;
        $this->code = $code;
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
