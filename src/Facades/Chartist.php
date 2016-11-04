<?php

namespace BrianFaust\Chartist\Facades;

use Illuminate\Support\Facades\Facade;

class Chartist extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chartist';
    }
}
