<?php

namespace App\Analytics\Domain\Repositories;

use App\Analytics\Domain\Models\AdAnalytic;
use App\App\Domain\Repositories\Repository;

class AnalyticRepository extends Repository
{
    protected $model;

    public function __construct(AdAnalytic $analytics)
    {
        $this->model = $analytics;
    }
}
