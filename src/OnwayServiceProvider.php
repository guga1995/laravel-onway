<?php

namespace Zorb\Onway;

use Illuminate\Support\ServiceProvider;

class OnwayServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->publishes([
			__DIR__ . '/config/onway.php' => config_path('onway.php'),
		], 'config');

		$this->mergeConfigFrom(__DIR__ . '/config/onway.php', 'onway');
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'onway');

		$this->publishes([
			__DIR__ . '/resources/lang' => resource_path('lang/vendor/onway'),
		]);

		if (!class_exists('CreateOnwayOrdersTable')) {
			$this->publishes([
				__DIR__ . '/migrations/create_onway_orders_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_onway_orders_table.php'),
			], 'migrations');
		}

		$this->app->bind(Onway::class);
	}
}
