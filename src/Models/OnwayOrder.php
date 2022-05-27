<?php

namespace Zorb\Onway\Models;

use Illuminate\Database\Eloquent\Model;

class OnwayOrder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'services' => 'array',
        'images' => 'array',
    ];
}
