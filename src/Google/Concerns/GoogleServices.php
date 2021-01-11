<?php

namespace FDC\Google\Concerns;

use Exception;
use FDC\Google\Concerns\GoogleAuthorization;
use FDC\Google\GoogleClient;

/**
 * Provides a `getClient` method. Classes using this concern must also
 * implement the `GoogleAuthorization` concern.
 *
 * @see \FDC\Google\Concerns\GoogleAuthorization
 */
trait GoogleServices
{
	/**
	 * Get an authorized `Google_Client` instance.
	 *
	 * @return \Google_Client
	 * @throws \Exception When class does not implement `GoogleAuthorization`
	 */
	public function getClient(): \Google_Client
	{
		if (!$this instanceof GoogleAuthorization) {
			throw new Exception(
				'Classes using GoogleServices must also implement GoogleAuthorization.'
			);
		}

		return (new GoogleClient)->get(call_user_func([$this, 'scopes']));
	}
}
