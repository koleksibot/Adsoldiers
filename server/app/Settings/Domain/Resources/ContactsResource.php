<?php

namespace App\Settings\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactsResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'lat' => $this->lat,
			'lng' => $this->lng,
			'email' => $this->email,
			'mobile' => $this->mobile,
			'address' => $this->address,
			'facebook' => $this->facebook,
			'twitter' => $this->twitter,
			'instagram' => $this->instagram,
		];
	}
}