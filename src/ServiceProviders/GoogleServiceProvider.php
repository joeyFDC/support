<?php

namespace FDC\Support\ServiceProvidcders;

use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
	protected static string $routes = __DIR__ . '/routes.php';
	protected static string $lang = __DIR__ . '/../resources/lang';
	protected static string $views = __DIR__ . '/../resources/views';
	protected static string $assets = __DIR__ . '/../resources/assets';
	protected static string $config = __DIR__ . '/../config/google.php';
	protected static string $migrations = __DIR__ . '/../database/migrations';

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// $this->loadTranslationsFrom(self::$lang, 'google');
		// $this->loadViewsFrom(self::$views, 'google');
		// $this->loadMigrationsFrom(self::$migrations);
		// $this->loadRoutesFrom(self::$routes);

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

		// Publish views
		//$this->publishes([self::$views => resource_path('views/vendor/fdc')], 'google.views');

		// Publish assets
		//$this->publishes([self::$assets => public_path('vendor/fdc')], 'google.assets');

		// Publish translation files
		//$this->publishes([self::$lang => resource_path('lang/vendor/fdc')], 'google.lang');

		// Register package commands
		// $this->commands([]);
	}
}
