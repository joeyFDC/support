<?php

namespace FDC\Sheets\Actions;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFile implements FromArray, WithHeadings
{
	use Exportable;

	public array $data;

	public array $headings;

	/**
	 * Start a new export, with the given `Collection` of data.
	 *
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		$this->headings = array_keys($data[0]);
		$this->data = $data;
	}

	public function headings(): array
	{
		return $this->headings;
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
