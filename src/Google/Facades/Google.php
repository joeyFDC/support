<?php

namespace FDC\Google\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Google_Client client(string ...$scopes)
 */
class Google extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'google';
	}
}
