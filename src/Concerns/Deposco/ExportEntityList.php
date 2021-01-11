<?php

namespace FDC\Support\Concerns\Deposco;

use FDC\Support\Sheets\Facades\Sheets;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ExportEntityList
{

	public string $url = 'https://fdc.deposco.com/solution/ExportEntityList?';

	private string $baseParams = 'companyCode=FDC&userId=1599&exportType=CSV&exportRange=All&';

	private string $parameters;

	public function params(array $params): void
	{
		$this->parameters = $this->baseParams . implode('&', $params);
	}

	/**
	 * Send the export http request, and store the file locally.
	 * CSV is then read in to a Collection.
	 *
	 * @return Collection
	 */
	public function get(): Collection
	{
		$path = $this->getPath();

		Storage::disk('local')->put($path, Http::get($this->url . $this->parameters));

		$export = Sheets::import($path, 'local');

		Storage::disk('local')->delete($path);

		return $export;
	}


	private function getPath(): string
	{
		return 'fdc/' . implode(' ', ['stockUnit', now()->format('Ymdhis')]) . '.csv';
	}
}
