<?php

namespace App\Payment\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Payment\Domain\Models\SoldierTransaction;

class SoldierTransactionRepository extends Repository
{
    protected $model;

    public function __construct(SoldierTransaction $category)
    {
        $this->model = $category;
    }
}
