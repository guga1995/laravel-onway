<?php

return [

    /**
     * This value decides to log or not to log requests.
     */
    'debug' => env('ONWAY_DEBUG', false),

    /**
     * This is the customer id, which should be generated
     * by onway tech stuff.
     */
    'onway_id' => env('ONWAY_ID'),

    /**
     * This is the url provided by onway.ge developer
     */
    'api_url' => env('ONWAY_API_URL', 'https://onway.ge/api/index.php'),

    /*
     * This model will be used to save deliveries.
     * It should implement the Zorb\Onway\Contracts\Delivery interface
     * and extend Illuminate\Database\Eloquent\Model.
     */
    'delivery_model' => \Zorb\Onway\Models\Delivery::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Delivery model shipped with this package.
     */
    'table_name' => 'deliveries',
];
