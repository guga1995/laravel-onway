<?php

namespace Zorb\Onway\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Zorb\Onway\Facades\Onway;
use Zorb\Onway\Models\OnwayOrder;

class OnwaySync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $page;

    private $limit;

    public function __construct($page, $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Onway::orderList()
            ->page($this->page)
            ->limit($this->limit)
            ->send();

        foreach ($response->toArray()['data'] as $item) {
            OnwayOrder::query()->updateOrCreate([
                'tracking_number' => $item['tracking_number']
            ], $item);
        }
        
        dump([$this->page, $this->limit, $response->recordsTotal]);

        if (count($response->data) > 0) {
            OnwaySync::dispatch($this->page + 1, $this->limit);
        }
    }
}
