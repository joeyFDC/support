<?php

namespace FDC\Support\Actions\Google;

class Authorization
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
