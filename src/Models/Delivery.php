<?php

namespace Zorb\Onway\Models;

use Zorb\Onway\Contracts\Delivery as DeliveryContract;
use Illuminate\Database\Eloquent\Model;
use BenSampo\Enum\Traits\CastsEnums;
use Zorb\Onway\Enums\DeliveryStatus;

class Delivery extends Model implements DeliveryContract
{
    use CastsEnums;

    //
    protected $fillable = [
        'status',
        'weight',
        'quantity',
        'order_id',
        'description',
        'tracking_number',
        'delivery_location',
        'collection_location',
    ];

    //
    protected $enumCasts = [
        'status' => DeliveryStatus::class,
    ];

    //
    protected $casts = [
        'weight' => 'float',
        'status' => 'integer',
        'order_id' => 'integer',
        'quantity' => 'integer',
        'delivery_location' => 'array',
        'collection_location' => 'array',
    ];
}
