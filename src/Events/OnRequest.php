<?php
 
namespace Zorb\Onway\Events;
 
use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
 
class OnRequest
{
    use Dispatchable;

    public $url;

    public $data;
 
    public function __construct(string $url, array $data)
    {
        $this->url = $url;
        $this->order = $data;
    }
}