<?php
 
namespace Zorb\Onway\Events;

use Illuminate\Foundation\Events\Dispatchable;

class OnResponse
{
    use Dispatchable;

    public $response;
 
    public function __construct($response)
    {
        $this->response = $response;
    }
}