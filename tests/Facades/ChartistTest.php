<?php



declare(strict_types=1);

namespace BrianFaust\Tests\Chartist\Facades;

use BrianFaust\Chartist\Builder;
use BrianFaust\Chartist\Facades\Chartist;
use BrianFaust\Tests\Chartist\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

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
