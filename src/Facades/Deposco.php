<?php

namespace FDC\Deposco\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getExportUrl(array $params)
 * @method static \FDC\Support\Record orderHeaders(string $businessUnit, string $type, string $status)
 * @method static \FDC\Support\Record orderLines(string $orderHeader)
 * @method static \FDC\Support\Record stockUnits(string $businessUnit)
 * @method static \FDC\Support\Record filterWarehouse(Record $data, string $warehouse)
 * @method static \FDC\Support\Record filterInvalidLocations(Record $data)
 */
class Deposco extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'deposco';
	}
}
