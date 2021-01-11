<?php

namespace FDC\Support\Concerns\Deposco;

use FDC\Support\Facades\Sheets;
use FDC\Support\Files;

class PurchaseOrder
{
	protected array $items = [];

	/**
	 * Get a blank item array.
	 *
	 * @return array
	 */
	public function itemTemplate(): array
	{
		return [
			'business_unit' => null,
			'po_number' => null,
			'item' => null,
			'order_quantity' => 0,
			'planned_arrival_date' => null,
			'case_sku' => null,
			'case_qty' => 0,
			'943_number' => null
		];
	}

	/**
	 * Add one or more purchase order items.
	 *
	 * @param array  $items  A single associative item array, or an array of associative item arrays.
	 * @return PurchaseOrder
	 */
	public function items(array $items): PurchaseOrder
	{
		// Check for more than one item
		if (isset($items[0])) {
			// Add all items
			foreach ($items as $item) {
				$this->addItem($item);
			}

			return $this;
		}

		// Add a single item
		$this->addItem($items);

		return $this;
	}

	/**
	 * Create a new CSV file for uploading to Deposco.
	 *
	 * @return string  Path to the created file
	 */
	public function create(): string
	{
		$fileName =
			implode('-', [
				$this->items[0]['business_unit'],
				$this->items[0]['po_number'],
				$this->items[0]['943_number']
			]) . '.csv';

		return $this->store($fileName, 'fdc');
	}

	/**
	 * Add a new item to the items property, with values from
	 * passed item.
	 */
	protected function addItem(array $item): void
	{
		$newItem = $this->itemTemplate();

		foreach ($newItem as $prop => $value) {
			$newItem[$prop] = $item[$prop] ?? $value;
		}

		$this->items[] = $newItem;
	}

	/**
	 * Export the purchase order upload form and get the file path.
	 *
	 * @param string $dir   Directory to store file in
	 * @param string|null $disk  Filesystem disk
	 * @return string
	 */
	protected function store(string $fileName, string $dir = '', ?string $disk = null): string
	{
		Sheets::export($this->items, $dir . '/' . $fileName, $disk);
		return Files::fullPath($dir . '/' . $fileName, $disk);
	}
}
