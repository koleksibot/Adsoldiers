<?php

namespace App\Payment\Advertiser\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Payment\Domain\Repositories\AdvertiserTransactionRepository;

class IndexAdvertiserOwnTransactionsService extends Service
{
    protected $transactions;

    public function __construct(AdvertiserTransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function handle($data = [])
    {
        return new GenericPayload(auth()->user()->advertiserTransactions()->paginate(10));
    }
}
