<?php

namespace App\Payment\Admin\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Payment\Domain\Repositories\SoldierTransactionRepository;

class IndexSoldiersTransactionsService extends Service
{
    protected $transactions;

    public function __construct(SoldierTransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function handle($data = [])
    {
        if (auth()->user()->can('index-all-transactions')) {
            return new GenericPayload($this->transactions->with('soldier')->paginate(10));
        }

        return new UnauthorizedPayload();
    }
}
