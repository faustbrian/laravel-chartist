<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Chartist.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Tests\Chartist\Facades;

use BrianFaust\Chartist\Builder;
use BrianFaust\Chartist\Facades\Chartist;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use BrianFaust\Tests\Chartist\AbstractTestCase;

class ChartistTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'chartist';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Chartist::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Builder::class;
    }
}
