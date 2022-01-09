<?php

namespace App\Payment\Domain\Repositories;

use App\Payment\Domain\Models\Balance;
use App\App\Domain\Repositories\Repository;

class BalanceRepository extends Repository
{
    protected $model;

    public function __construct(Balance $category)
    {
        $this->model = $category;
    }
}
