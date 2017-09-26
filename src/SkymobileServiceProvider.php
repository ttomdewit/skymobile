<?php

namespace Tomdewit\Skymobile;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Tomdewit\Skymobile\Exceptions\InvalidConfiguration;

class SkymobileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(SkymobileChannel::class)
            ->needs(SkymobileClient::class)
            ->give(function () {
                $config = config('services.skymobile');

                if (is_null($config)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new SkymobileClient(new Client());
            });
    }
}
