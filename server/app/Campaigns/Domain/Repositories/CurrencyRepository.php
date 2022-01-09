<?php

namespace App\Ads\Domain\Repositories;

use App\Ads\Domain\Models\Currency;
use App\App\Domain\Repositories\Repository;

class CurrencyRepository extends Repository {
	protected $model;

	public function __construct(Currency $model) {
		$this->model = $model;
	}
	public function getByAlpha3($currency) {
		return $this->model->where('iso4217_alpha3', $currency)->firstOrFail();
	}
}
