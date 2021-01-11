<?php

namespace FDC\Google\Concerns;

/**
 * Defines the requirements for authorizing Google's API requests.
 */
interface GoogleAuthorization
{
	/**
	 * Get requested scopes
	 *
	 * @return string|array
	 */
	public function scopes();
}
