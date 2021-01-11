<?php

namespace FDC\Support\ServiceProviders;

use FDC\Support\Commands\ExportCommand;
use FDC\Support\Commands\GetGoogleSheetCommand;
use FDC\Support\Commands\ImportCommand;
use FDC\Support\Sheets;
use Illuminate\Support\ServiceProvider;

class SheetsServiceProvider extends ServiceProvider
{
	protected static $config = __DIR__ . '/../../config/sheets.php';

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// Publishing is only necessary when using the CLI.
		$this->app->runningInConsole() && $this->bootForConsole();
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->mergeConfigFrom(self::$config, 'sheets');

		// Register the service the package provides.
		$this->app->singleton('sheets', function ($app) {
			return new Sheets();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['sheets'];
	}

	/**
	 * Console-specific booting.
	 *
	 * @return void
	 */
	protected function bootForConsole(): void
	{
		// Publishing the configuration file.
		$this->publishes([self::$config => config_path('sheets.php')], 'sheets.config');

		// Registering package commands.
		$this->commands([ImportCommand::class, GetGoogleSheetCommand::class, ExportCommand::class]);
	}
}
