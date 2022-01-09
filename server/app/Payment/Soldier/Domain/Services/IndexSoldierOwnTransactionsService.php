<?php

namespace App\Payment\Soldier\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Payment\Domain\Repositories\SoldierTransactionRepository;

class IndexSoldierOwnTransactionsService extends Service
{
    protected $payment;

    public function __construct(SoldierTransactionRepository $payment)
    {
        $this->payment = $payment;
    }

    public function handle($data = [])
    {
        return new GenericPayload(auth()->user()->soldierTransactions()->paginate(10));
    }
}
