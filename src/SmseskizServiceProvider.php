<?php

namespace Nekkoy\GatewaySmseskiz;

use Illuminate\Support\ServiceProvider;

/**
 *
 */
class SmseskizServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(\Nekkoy\GatewaySmseskiz\Services\GatewayService::class, function ($app) {
            return new \Nekkoy\GatewaySmseskiz\Services\GatewayService();
        });

        $this->app->singleton('gateway-smseskiz', function ($app) {
            return new \Nekkoy\GatewaySmseskiz\Services\GatewaySmseskizService();
        });
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('gateway-smseskiz.php')], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'gateway-smseskiz');
    }
}
