<?php

namespace FDC\Support\ServiceProviders;

use FDC\Support\Google;
use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
	protected static $config = __DIR__ . '/../../config/google.php';

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// Provide publishing options and commands for Artisan.
		$this->app->runningInConsole() && $this->bootForConsole();
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->mergeConfigFrom(self::$config, 'google');

		// Register the service the package provides.
		$this->app->singleton('google', function ($app) {
			return new Google();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['google'];
	}

	/**
	 * Provide publishing options, and Artisan commands.
	 *
	 * @return void
	 */
	protected function bootForConsole(): void
	{
		// Publish config
		$this->publishes([self::$config => config_path('fdc/google.php')], 'google.config');
	}
}
