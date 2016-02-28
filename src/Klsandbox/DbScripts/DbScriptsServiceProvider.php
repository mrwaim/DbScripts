<?php namespace Klsandbox\DbScripts;

use Illuminate\Support\ServiceProvider;
use Klsandbox\DbScripts\Console\Commands\DbCreateUser;

class DbScriptsServiceProvider extends ServiceProvider {

	/**
	* Indicates if loading of the provider is deferred.
	*
	* @var bool
	*/
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton('command.klsandbox.dbcreateuser', function() {
			return new DbCreateUser();
		});

		$this->commands('command.klsandbox.dbcreateuser');
	}

	/**
	* Get the services provided by the provider.
	*
	* @return array
	*/
	public function provides()
	{
		return [];
	}

	public function boot() {
		$this->publishes([
			__DIR__ . '/../../../scripts/' => base_path('scripts')
		], 'scripts');
	}
}
