<?php

namespace FDC\Sheets\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string alias(string $alias)
 * @method static \FDC\Support\Record import(string $filePath, ?string $disk)
 * @method static array google(string $id, string $range)
 * @method static string export(array $data, string $filePath, ?string $disk)
 *
 * @see \FDC\Sheets\Sheets
 */
class Sheets extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'sheets';
	}
}
