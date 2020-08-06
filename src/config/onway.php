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
];
