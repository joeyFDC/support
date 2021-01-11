<?php

namespace FDC\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Deposco extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'deposco';
	}
}
