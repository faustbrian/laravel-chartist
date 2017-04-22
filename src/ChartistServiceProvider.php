<?php



declare(strict_types=1);

namespace BrianFaust\Chartist;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class ChartistServiceProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishViews();

        $this->loadViews();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();

        $this->app->singleton('chartist', function ($app) {
            return new Builder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return array_merge(parent::provides(), ['chartist']);
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName(): string
    {
        return 'chartist';
    }
}
