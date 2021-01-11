<?php

namespace FDC\Support\Actions\Deposco;

use FDC\Support\Facades\Filter;

class FilterWarehouse
{
	/**
	 * Keeps only records where the value for `location` is in a given warehouse.
	 *
	 * @param \FDC\Support\Record|\Illuminate\Support\Collection|array $records  Items to be filtered.
	 * @param string $warehouse  The three letter abbreviation for a warehouse.
	 * @return \Illuminate\Support\Collection
	 */
	public function __invoke($records, string $warehouse)
	{
		return Filter::startsWith($records, 'location', $warehouse);
	}
}
