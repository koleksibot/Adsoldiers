<?php

namespace App\Campaigns\Domain\Resources;

use App\App\Domain\Resources\BaseResource;

class CurrencyResource extends BaseResource {
	public function toArray($request) {
		return array_merge([
			'id' => $this->id,
			'currency_name' => $this->currency_name,
			'currency_name_en' => $this->currency_name_en,
			'iso4217_alpha3' => $this->iso4217_alpha3,
			'iso4217_num3' => $this->iso4217_num3,
		], parent::toArray($request));
	}
}
