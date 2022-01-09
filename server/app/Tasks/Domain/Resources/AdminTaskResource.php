<?php

namespace App\Tasks\Domain\Resources;

use App\Tasks\Domain\Resources\TaskResource;

class AdminTaskResource extends TaskResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return array_merge(parent::toArray($request), [
			'points' => $this->points,
		]);
	}
}
