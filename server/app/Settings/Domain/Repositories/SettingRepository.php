<?php

namespace App\Settings\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Settings\Domain\Models\Setting;

class SettingRepository extends Repository {
	protected $model;

	public function __construct(Setting $model) {
		$this->model = $model;
	}
}
