<?php

return [
	/**
	 * This value decides to log or not to log requests.
	 */
	'debug' => [
		'enable' => env('ONWAY_DEBUG', false),
		'channel' => env('ONWAY_DEBUG_CHANNEL', null)
	],

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
];
