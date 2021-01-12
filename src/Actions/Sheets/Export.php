<?php

namespace FDC\Support\Actions\Sheets;

use FDC\Support\Record;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromArray, WithHeadings
{
	use Exportable;

	public array $data;
	public array $headings;
	public ?string $filePath;
	public ?string $disk;

	/**
	 * Start a new export using a source `array`, `Collection` or `Record`.
	 *
	 * @param array|Collection|Record $data
	 * @param string
	 */
	public function __construct($data, ?string $filePath = null, ?string $disk = null)
	{
		$this->data = $data instanceof Collection ? $data->toArray() : $data;
		$this->filePath = $filePath;
		$this->disk = $disk;
	}

	public function headings(): array
	{
		return array_keys($this->data[0]);
	}

	/**
	 * Provides the export data
	 *
	 * @return array
	 */
	public function array(): array
	{
		return $this->data;
	}
}
