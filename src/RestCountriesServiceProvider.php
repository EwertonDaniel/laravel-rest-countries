<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries;

use EwertonDaniel\RestCountries\Contracts\RestCountriesInterface;
use Illuminate\Support\ServiceProvider;

final class RestCountriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rest-countries.php', 'rest-countries');

        $this->app->singleton(RestCountriesInterface::class, RestCountries::class);
        $this->app->alias(RestCountriesInterface::class, 'rest-countries');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/rest-countries.php' => config_path('rest-countries.php'),
            ], 'rest-countries-config');
        }
    }
}
