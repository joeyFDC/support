<?php

namespace FDC\Support\Actions\Sheets;

use Google_Service_Sheets;
use FDC\Support\Actions\Google\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GoogleSheet
{
	protected Google_Service_Sheets $service;
	protected string $id;
	protected string $range;
	protected array $data;

	public function __construct()
	{
		$this->service = new Google_Service_Sheets((new Client)->get(Google_Service_Sheets::SPREADSHEETS));

		$rows = $this->service->spreadsheets_values->get($this->id, $this->range)->getValues();

		$keys = array_map(function ($heading) {
			return Str::snake($heading);
		}, array_shift($rows));

		$this->data = array_map(function ($row) use ($keys) {
			return array_combine($keys, $row);
		}, $rows);
	}

	public function toArray(): array
	{
		return $this->data;
	}

	public function toCollection(): Collection
	{
		return collect($this->data);
	}
}
