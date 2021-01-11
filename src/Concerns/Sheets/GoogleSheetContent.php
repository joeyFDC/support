<?php

namespace FDC\Sheets\Concerns;

use FDC\Sheets\Exceptions\InvalidConcernException;
use FDC\Sheets\Facades\Sheets;
use Illuminate\Support\Collection;

/**
 * Provides function to get data from a Google Sheet, and optionally key the content
 * by a given column heading. Classes using this trait must also implement the GoogleSheet concern.
 *
 * @see \FDC\Sheets\Concerns\GoogleSheet
 */
class GoogleSheetContent
{
	protected Collection $data;
	protected Collection $keys;
	protected string $key = '';

	public function __construct()
	{
		if (!$this instanceof \FDC\Sheets\Concerns\GoogleSheet) {
			throw new InvalidConcernException(
				'Classes extending GoogleSheetData must also implement DataFromGoogleSheets.'
			);
		}

		$this->googleContent = Sheets::google(
			call_user_func([$this, 'googleSheetId']),
			call_user_func([$this, 'googleSheetRange'])
		)->toCollection();

		$this->data = $this->googleContent;
		$this->keys = collect($this->data->keys()->all());
	}
}
