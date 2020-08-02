<?php

namespace Zorb\Onway;

use Zorb\Onway\Exceptions\InvalidConfigurationException;
use Zorb\Onway\Contracts\Delivery as DeliveryContract;
use Zorb\Onway\Models\Delivery as DeliveryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Zorb\Onway\Contracts\Delivery;

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

        if (!class_exists('CreateDeliveriesTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/migrations/create_deliveries_table.php.stub' => database_path("/migrations/{$timestamp}_create_deliveries_table.php"),
            ], 'migrations');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Onway::class);
    }

    //
    public static function determineModel(): string
    {
        $model = config('onway.delivery_model') ?? DeliveryModel::class;

        if (!is_a($model, Delivery::class, true)
            || !is_a($model, Model::class, true)) {
            throw InvalidConfigurationException::modelIsNotValid($model);
        }

        return $model;
    }

    //
    public static function getModelInstance(): DeliveryContract
    {
        $modelClassName = self::determineModel();

        return new $modelClassName();
    }
}
