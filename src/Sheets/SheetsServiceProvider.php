<?php

namespace FDC\Sheets;
use FDC\Sheets\Commands\ExportCommand;
use FDC\Sheets\Commands\GetGoogleSheetCommand;
use FDC\Sheets\Commands\ImportCommand;
use FDC\Sheets\Sheets;
use Illuminate\Support\ServiceProvider;

class SheetsServiceProvider extends ServiceProvider
{
	protected static string $routes = __DIR__ . '/routes.php';
	protected static string $lang = __DIR__ . '/../resources/lang';
	protected static string $views = __DIR__ . '/../resources/views';
	protected static string $config = __DIR__ . '/../config/sheets.php';
	protected static string $migrations = __DIR__ . '/../database/migrations';

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// $this->loadTranslationsFrom(self::$lang, 'sheets');
		// $this->loadViewsFrom(self::$views, 'sheets');
		// $this->loadMigrationsFrom(self::$migrations);
		// $this->loadRoutesFrom(self::$routes);

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
