<?php

namespace FDC\Support\Actions\Deposco;

use FDC\Support\Concerns\Deposco\Request;
use Illuminate\Support\Collection;

class GetOrderHeaders extends Request
{
	public function __invoke(string $company, string $type, ?string $status = null): Collection
	{
		$this->key = 'order';
		$this->path('search/Order');
		$this->params(['company' => $company, 'type' => $type]);
		!!$status && $this->params(['currentStatus' => $status]);

		return collect(array_map(function ($order) {
			return [
				'businessUnit' => $order['businessUnit'],
				'id' => $order['id'],
				'number' => $order['number'],
				'type' => $order['type'],
				'status' => $order['status'],
				'createdDateTime' => $order['createdDateTime'],
				'updatedDateTime' => $order['updatedDateTime']
			];
		}, $this->get($this->key)))->keyBy('number');
	}
}
