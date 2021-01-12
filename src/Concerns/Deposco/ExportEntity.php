<?php

namespace FDC\Support\Concerns\Deposco;

use FDC\Support\Facades\Sheets;
use FDC\Support\Files;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ExportEntity
{
	private string $url = 'https://fdc.deposco.com/solution/ExportEntityList?';
	private string $baseParams = 'companyCode=FDC&userId=1599&exportType=CSV&exportRange=All&';

	/**
	 * Send the export http request, and store the file locally.
	 * CSV is then read in to a Collection.
	 */
	public function get(array $params): array
	{
		$path = Files::tmp(Http::get($this->url . $this->baseParams . implode('&', $params)), 'csv');

		$data = Sheets::import($path, 'local');

		Storage::disk()->delete(Str::after($path, storage_path('app')));

		return $data;
	}
}
