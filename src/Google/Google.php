<?php

namespace FDC\Google;

use \Google_Client;
use FDC\Google\GoogleClient;

class Google
{
	/**
	 * Get an authorized Google API Client for a service with given scopes.
	 * A service class must implement `AuthorizeGoogleServices` and use `GoogleServices`.
	 *
	 * @param string[] $scopes The scopes from a GoogleService class.
	 * @return Google_Client
	 * @see \FDC\Support\Concerns\AuthorizeGoogleServices
	 * @see \FDC\Support\Conerns\GoogleServices
	 */
	public function client(string ...$scopes): Google_Client
	{
		return (new GoogleClient)->get(...$scopes);
	}
}
