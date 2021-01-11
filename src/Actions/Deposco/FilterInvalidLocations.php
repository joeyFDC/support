<?php

namespace FDC\Support\Actions\Deposco;

use FDC\Support\Facades\Filter;

class FilterInvalidLocations
{
	/**
	 * Keep records where the value for `location` is not invalid.
	 *
	 * @param array|\Illuminate\Support\Collection $records Items to be filtered.
	 * @return \Illuminate\Support\Collection
	 */
	public function __invoke($records)
	{
		$invalidLocations = [
			'SHIPPING',
			'WHSE--FLOOR',
			'MANUAL HOLD',
			'MANUAL ADJUSTMENT',
			'TEST',
			'PACKINGSLIP',
			'REC',
			'RECEIVING',
			'RETURNS'
		];

		return Filter::notEndsWith($records, 'location', ...$invalidLocations);
	}
}
