<?php

namespace FDC\Sheets\Actions;

use FDC\Google\Concerns\GoogleAuthorization;
use FDC\Google\Concerns\GoogleServices;
use FDC\Support\Record;
use Google_Service_Sheets;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GoogleImport implements GoogleAuthorization
{
	use GoogleServices;

	protected Google_Service_Sheets $service;

	/**
	 * Initiate a new Google Sheets service with an authorized client.
	 */
	public function __construct()
	{
		$this->service = new Google_Service_Sheets($this->getClient());
	}

	/**
	 * Get contents of Google Sheet as a Collection
	 *
	 * @param string $id  Google sheet ID (Found in URL).
	 * @param string $range Sheet and range to read - ie: `'Sheet1!A:I'`
	 * @return array
	 */
	public function get(string $id, string $range, string $keyFormat = 'snake'): array
	{
		$rows = $this->service->spreadsheets_values->get($id, $range)->getValues();

		$headings = array_map(function ($heading) use ($keyFormat) {
			return Str::$keyFormat($heading);
		}, array_shift($rows));

		return array_map(function ($row) use ($headings) {
			return array_combine($headings, $row);
		}, $rows);
	}

	/**
	 * Get Google Client scopes.
	 *
	 * @return string|array
	 */
	public function scopes()
	{
		return Google_Service_Sheets::SPREADSHEETS;
	}
}
