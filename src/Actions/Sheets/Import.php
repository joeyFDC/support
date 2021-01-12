<?php

namespace FDC\Support\Actions\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToArray, WithHeadingRow
{
	use Importable;

	public function array(array $array)
	{
		//
	}
}
