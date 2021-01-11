<?php

namespace FDC\Support\Actions\Deposco;

use FDC\Support\Concerns\Deposco\ExportEntityList;
use Illuminate\Support\Collection;

class GetStockUnits extends ExportEntityList
{
	public function __invoke(string $businessUnit): Collection
	{
		$this->params([
			'entityName=StockUnit',
			'viewId=10932',
			'numOfFilters=1',
			'onDemandFilterName0=Business+Unit',
			'onDemandFilterFieldName0=company',
			'onDemandFilterValue0=' . $businessUnit
		]);

		return collect($this->get()->keyBy('item')->toArray());
	}
}
