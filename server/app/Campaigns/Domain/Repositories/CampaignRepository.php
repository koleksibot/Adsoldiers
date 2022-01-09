<?php

namespace App\Campaigns\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Campaigns\Domain\Models\Campaign;

class CampaignRepository extends Repository {
	protected $model;
	public function __construct(Campaign $campaigns) {
		$this->model = $campaigns;
	}
}