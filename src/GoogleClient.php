<?php

namespace FDC\Support;

use Google_Client;
use Illuminate\Support\Facades\File;

/**
 * Handles authorizing a Google API Client.
 *
 * A service class should implement `AuthorizeGoogleServices` and use `GoogleServices`.
 *
 * @see \FDC\Support\Concerns\AuthorizeGoogleServices
 * @see \FDC\Support\Conerns\GoogleServices
 */
class GoogleClient
{
	protected Google_Client $client;

	protected string $token;

	protected string $authConfig;

	public function get(string ...$scopes): Google_Client
	{
		$this->token = config('google.token');
		$this->authConfig = config('google.auth');

		$this->client = new Google_Client;
		$this->client->setApplicationName('FDC Google Services');
		$this->client->setAccessType('offline');
		$this->client->setPrompt('select_account consent');
		$this->client->setAuthConfig($this->authConfig);
		$this->client->setScopes($scopes);

		if ($this->setToken()) {
			return $this->client;
		}
	}

	protected function setToken(): bool
	{
		if (File::exists($this->token)) {
			$this->client->setAccessToken(json_decode(File::get($this->token), true));

			if (!$this->client->isAccessTokenExpired()) {
				return true;
			}

			if ($this->client->isAccessTokenExpired() && $this->client->getRefreshToken()) {
				$this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
				return true;
			}
		}

		return $this->login();
	}

	protected function login(): bool
	{
		print "WEB LOGIN REQUIRED\n";
		$authUrl = $this->client->createAuthUrl();
		// After login, request they copy the code and paste here
		printf("OPEN THE FOLLOWING LINK:\n%s\n", $authUrl . "\n");
		print "\n\nPASTE PROVIDED CODE HERE: ";
		// Capture user input.
		$authCode = trim(fgets(STDIN));

		// Exchange authorization code for an access token.
		$this->client->setAccessToken($this->client->fetchAccessTokenWithAuthCode($authCode));

		File::ensureDirectoryExists(dirname($this->token), 0700, true);
		File::put($this->token, json_encode($this->client->getAccessToken()));

		return true;
	}
}
