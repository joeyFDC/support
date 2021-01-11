<?php

namespace FDC\Sheets;

use App\Http\Controllers\Controller;
use FDC\Sheets\Actions\ExportFile;
use FDC\Sheets\Actions\ImportFile;
use FDC\Sheets\Actions\GoogleImport;
use FDC\Support\Record;
use Illuminate\Support\Collection;

class Sheets extends Controller
{

	/** Cached data as a Record instance. */
	public Record $data;


	/**
	 * Get the id for a configured Google Sheets alias.
	 *
	 * @param string $alias
	 * @return string
	 */
	public function alias(string $alias): string
	{
		return config('sheets.alias.' . $alias, $alias);
	}

	/**
	 * Import the contents of a csv, xls or xlsx file as a Record class.
	 *
	 * @param string $filePath
	 * @param string|null $disk
	 * @return Collection
	 */
	public function import(string $filePath, ?string $disk = null): Collection
	{
		return collect((new ImportFile)->toArray($filePath, $disk)[0]);
	}

	/**
	 * Import the contents of a Google Sheet
	 *
	 * @param string $id
	 * @param string $range
	 * @return array
	 */
	public function google(string $id, string $range): array
	{
		return (new GoogleImport)->get($id, $range);
	}

	/**
	 * Store data as a spreadsheet.
	 *
	 * @param array $data
	 * @param string $filePath
	 * @param string|null $disk
	 * @return string  Path to stored file.
	 */
	public function export(array $data, string $filePath, ?string $disk = null): string
	{
		$export = new ExportFile($data);
		return $export->store($filePath, $disk);
	}
}
