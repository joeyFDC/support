<?php

namespace FDC\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Filter
{
	protected function normalizeAll(array $values): array
	{
		return array_map(function ($value) {
			return $this->normalize($value);
		}, $values);
	}

	protected function normalize(string $value): string
	{
		return Str::upper(str_ireplace([' ', '-'], '_', $value));
	}

	/**
	 * Keeps records where the property starts with any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function startsWith($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return Str::startsWith($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property does not start with any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return \FDC\Support\Record
	 */
	public function notStartsWith($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return !Str::startsWith($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property ends with any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function endsWith($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return Str::endsWith($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property does not end with any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function notEndsWith($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return !Str::endsWith($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property contains any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function contains($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return Str::contains($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property does not contain any provided value.
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function notContains($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return !Str::contains($this->normalize($record[$property]), $this->normalizeAll($values));
		})->collect();
	}

	/**
	 * Keeps records where the property equals any provided value.
	 *
	 * Values may include wildcards, ie: `'*Jedi Kight', 'Darth*'`
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function is($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return Str::is($this->normalizeAll($values), $this->normalize($record[$property]));
		})->collect();
	}

	/**
	 * Keeps records where the property does not equal any provided value.
	 *
	 * Values may include wildcards, ie: `'*Binks', 'JarJar*'`
	 *
	 * @param array|Collection|Record $records The items being tested.
	 * @param string $property The key or field name being tested.
	 * @param string[] ...$values Any number of values to test against.
	 * @return Collection
	 */
	public function isNot($records, string $property, string ...$values): Collection
	{
		return collect($records)->filter(function ($record) use ($property, $values) {
			return !Str::is($this->normalizeAll($values), $this->normalize($record[$property]));
		})->collect();
	}
}
