<?php namespace Battambang\Loan;

use Illuminate\Support\ServiceProvider;

class LoanServiceProvider extends ServiceProvider {

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
		$this->package('battambang/loan','battambang/loan');
        include __DIR__ .'/../../routes.php';
        include __DIR__ .'/../../menus.php';
        include __DIR__ .'/../../page_headers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        // Facade for Lookup Value
        $this->app['lookupValueList'] = $this->app->share(
            function ($app) {
                return new Libraries\LookupValueList;
            }
        );

        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('LookupValueList', 'Battambang\Loan\Facades\LookupValueList');
            }
        );

        // Facade for ScheduleGenerate
        $this->app['schedule_generate'] = $this->app->share(
            function ($app) {
                return new Libraries\ScheduleGenerate;
            }
        );

        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('ScheduleGenerate', 'Battambang\Loan\Facades\ScheduleGenerate');
            }
        );
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}