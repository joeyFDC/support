<?php

namespace FDC\Support;

use FDC\Support\Actions\Deposco\GetOrderHeaders;
use FDC\Support\Actions\Deposco\GetStockUnits;
use FDC\Support\Actions\Deposco\FilterInvalidLocations;
use FDC\Support\Actions\Deposco\FilterWarehouse;
use FDC\Support\Concerns\Deposco\PurchaseOrder;
use Illuminate\Support\Collection;

class Deposco
{
	public function purchaseOrder(array $items)
	{
		return (new PurchaseOrder)->items($items)->create();
	}

	public function getOrderHeaders(string $businessUnit, string $type, ?string $status = null)
	{
		return (new GetOrderHeaders)($businessUnit, $type, $status);
	}

	public function getStockUnits(string $businessUnit)
	{
		return (new GetStockUnits)($businessUnit);
	}

	public function filterInvalidLocations(Collection $data)
	{
		return (new FilterInvalidLocations)($data);
	}

	public function filterWarehouse(Collection $data, string $warehouse)
	{
		return (new FilterWarehouse)($data, $warehouse);
	}
}
