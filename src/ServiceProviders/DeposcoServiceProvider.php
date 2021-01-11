<?php

namespace FDC\Support\ServiceProvidcders;

use FDC\Support\Deposco;
use Illuminate\Support\ServiceProvider;

class DeposcoServiceProvider extends ServiceProvider
{
	protected static string $config = __DIR__ . '/../../config/deposco.php';
	protected static string $routes = __DIR__ . '../../routes/deposco.php';

	public function boot(): void
	{
		$this->loadRoutesFrom(self::$routes);

		$this->app->runningInConsole() && $this->bootForConsole();
	}

	public function register(): void
	{
		$this->mergeConfigFrom(self::$config, 'deposco');

		$this->app->singleton('deposco', function ($app) {
			return new Deposco();
		});
	}

	public function provides(): array
	{
		return ['deposco'];
	}

	protected function bootForConsole(): void
	{
		$this->publishes([self::$config => config_path('fdc/deposco.php')], 'deposco.config');
	}
}
