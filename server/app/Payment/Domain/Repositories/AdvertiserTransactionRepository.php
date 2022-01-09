<?php

namespace App\Payment\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Payment\Domain\Models\AdvertiserTransaction;

class AdvertiserTransactionRepository extends Repository
{
    protected $model;

    public function __construct(AdvertiserTransaction $category)
    {
        $this->model = $category;
    }
}
