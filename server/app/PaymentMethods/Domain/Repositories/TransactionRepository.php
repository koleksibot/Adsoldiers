<?php

namespace App\Payment\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Payment\Domain\Models\Transaction;

class TransactionRepository extends Repository
{
    protected $model;

    public function __construct(Transaction $category)
    {
        $this->model = $category;
    }
}
