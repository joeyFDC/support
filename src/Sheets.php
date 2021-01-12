<?php

namespace FDC\Support;

use App\Http\Controllers\Controller;
use FDC\Support\Actions\Sheets\Export;
use FDC\Support\Actions\Sheets\Import;
use FDC\Support\Actions\Sheets\GoogleSheet;

class Sheets extends Controller
{
	/**
	 * Get content of csv, xls, xlsx or GoogleSheet as an array.
	 *
	 * @param string $type Either 'file' or 'google'
	 * @param string $ref Path of 'file' | id of 'google' sheet
	 * @param string|null $disk
	 */
	public function import(string $type = 'file', string $ref, ?string $disk = null): array
	{
		return $type === 'file' ? (new Import)->toArray($ref, $disk)[0] : (new GoogleSheet)->toArray();
	}

	/**
	 * Start a new export using a source `array`, `Collection` or `Record`.
	 *
	 * @param array|Collection|Record $data
	 * @param string|null $filePath
	 * @param string|null $disk
	 */
	public function export($data, ?string $filePath = null, ?string $disk = null)
	{
		(new Export($data, $filePath, $disk))->store();
	}

	/**
	 * Export a source `array`, `Collection` or `Record` to a spreadsheet, and trigger client download.
	 *
	 * @param array|Collection|Record $data
	 * @param string|null $filePath
	 */
	public function download($data, ?string $filePath = null)
	{
		(new Export($data, $filePath))->download();
	}
}
