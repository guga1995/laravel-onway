<?php
 
namespace Zorb\Onway\Events;
 
use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
 
class OnResponse
{
    use Dispatchable;

    public $url;

    public $data;
 
    public function __construct(string $url, $data)
    {
        $this->url = $url;
        $this->order = $data;
    }
}