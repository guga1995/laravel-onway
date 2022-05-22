<?php

namespace App\Exceptions;

use Exception;

class OnwayResponseException extends Exception {

    private $response;
    
    public function __construct($response)
    {
        $this->message = 'Something went wrong';
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
