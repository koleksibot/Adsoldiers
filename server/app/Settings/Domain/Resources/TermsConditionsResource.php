<?php

namespace App\Settings\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermsConditionsResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'terms' => $this->privacy_policy,
		];
	}
}
