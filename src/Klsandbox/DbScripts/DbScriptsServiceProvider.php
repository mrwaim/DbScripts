<?php namespace Klsandbox\DbScripts;

use Illuminate\Support\ServiceProvider;

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
	public function register()
	{
		//
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
