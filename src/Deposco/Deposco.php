<?php

namespace FDC\Deposco;

use FDC\Deposco\Actions\GetOrderHeaders;
use FDC\Deposco\Actions\GetStockUnits;
use FDC\Deposco\Actions\FilterInvalidLocations;
use FDC\Deposco\Actions\FilterWarehouse;
use FDC\Deposco\Concerns\PurchaseOrder;
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
