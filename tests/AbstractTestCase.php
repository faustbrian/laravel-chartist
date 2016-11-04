<?php

namespace BrianFaust\Tests\Chartist;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use BrianFaust\Chartist\ServiceProvider;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return ServiceProvider::class;
    }
}
