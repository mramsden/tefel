<?php namespace Tefel;

use Illuminate\Support\ServiceProvider;
use Tefel\JourneyPlanner\Command\ImportJourneyPlannerTimetable;

class TefelServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('mramsden/tefel', 'tefel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->config->package('mramsden/tefel', realpath(__DIR__.'/../config'), 'tefel');

        $this->app->bindShared('tefel', function($app)
        {
            return new Tefel(
                $app->config['tefel::stations_feed_url'],
                $app->config['tefel::app_id'],
                $app->config['tefel::app_key']
            );
        });

        $this->commands(ImportJourneyPlannerTimetable::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('tefel');
    }

}
