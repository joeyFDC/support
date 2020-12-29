<?php

namespace FDC\Support\Concerns;

use FDC\Support\Record;
use Illuminate\Support\Collection;

/**
 * Provides functions for converting data sets into common formats.
 */
trait ImportDataFormats
{
	protected Record $dataCache;

	/**
	 * Normalize incoming `Records`, `Collections`, arrays or encoded json strings to a `Record`.
	 *
	 * @param Record|Collection|array|string $data
	 * @return void
	 */
	protected function setDataCache($data): void
	{
		if ($data instanceof Record) {
			$this->dataCache = $data;
		}

		if (!$data instanceof Record && $data instanceof Collection) {
			$this->dataCache = record($data->all());
		}

		if (is_array($data)) {
			$this->dataCache = record($data);
		}

		if (is_string($data)) {
			$this->dataCache = record(json_decode($data, true));
		}
	}

	/**
	 * Get the imported data as an array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		return $this->dataCache->toArray() ?? [];
	}

	/**
	 * Get the imported data as a `Collection`
	 *
	 * @return Collection
	 */
	public function toCollection(): Collection
	{
		return collect($this->dataCache->all()) ?? collect();
	}

	/**
	 * Get the imported data as a `Record`
	 *
	 * @return Record
	 */
	public function toRecord(): Record
	{
		return $this->dataCache ?? record();
	}

	/**
	 * Get the imported data as a json string.
	 *
	 * @param bool $formatted  `true` removes escape characters and format (pretty print).
	 * @return string
	 */
	public function toJson(bool $formatted = false): string
	{
		return !$formatted
			? $this->dataCache->toJson()
			: stripslashes(json_encode($this->dataCache->toArray(), JSON_PRETTY_PRINT));
	}

	/**
	 * Store imported data as json to a given path.
	 *
	 * @param bool $formatted  `true` removes escape characters and format (pretty print).
	 * @return bool
	 */
	public function store(string $path, bool $formatted = false): bool
	{
		return file_put_contents($path, $this->toJson($formatted));
	}
}
