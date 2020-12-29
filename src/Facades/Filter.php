<?php

namespace FDC\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Record startsWith($records, string $property, string ...$values)
 * @method static Record notStartsWith($records, string $property, string ...$values)
 * @method static Record endsWith($records, string $property, string ...$values)
 * @method static Record notEndsWith($records, string $property, string ...$values)
 * @method static Record contains($records, string $property, string ...$values)
 * @method static Record notContains($records, string $property, string ...$values)
 * @method static Record is($records, string $property, string ...$values)
 * @method static Record isNot($records, string $property, string ...$values)
 * @see \FDC\Support\Filter
 */
class Filter extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(): string
	{
		return 'filter';
	}
}
