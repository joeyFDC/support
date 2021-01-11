<?php

namespace FDC\Support\ServiceProviders;

use FDC\Support\Filter;
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
