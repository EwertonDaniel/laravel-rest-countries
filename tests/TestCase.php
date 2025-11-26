<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Tests;

use EwertonDaniel\RestCountries\RestCountriesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [RestCountriesServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('rest-countries.base_url', 'https://restcountries.com/v3.1');
        $app['config']->set('rest-countries.log_channel', 'stack');
    }
}
