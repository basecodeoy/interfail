<?php

declare(strict_types=1);

namespace Tests;

use PreemStudio\Interfail\ServiceProvider;
use PreemStudio\Jetpack\Tests\AbstractTestCase;
use Spatie\LaravelData\LaravelDataServiceProvider;

abstract class TestCase extends AbstractTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelDataServiceProvider::class,
            ServiceProvider::class,
        ];
    }
}
