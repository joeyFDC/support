<?php

namespace FDC\Support;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		//
	}

	public function register(): void
	{
		$this->app->singleton('filter', function ($app) {
			return new Filter();
		});
	}

	public function provides()
	{
		return ['filter'];
	}
}
