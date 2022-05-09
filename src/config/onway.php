<?php

return [
	/**
	 * This value decides to log or not to log requests.
	 */
	'debug' => env('ONWAY_DEBUG', false),

	/**
	 * Should be provided by onway tech stuff.
	 */
	'username' => env('ONWAY_USER'),

	/**
	 * Should be provided by onway tech stuff.
	 */
	'key' => env('ONWAY_KEY'),

	/**
	 * This is the url provided by onway.ge developer
	 */
	'base_api_url' => env('ONWAY_BASE_API_URL', 'https://onway.ge/index.php'),

	/**
	 * This is the url provided by onway.ge developer
	 */
	'delivery_api_url' => env('ONWAY_DELIVERY_API_URL', 'https://delivery.onway.ge/index.php'),
];
