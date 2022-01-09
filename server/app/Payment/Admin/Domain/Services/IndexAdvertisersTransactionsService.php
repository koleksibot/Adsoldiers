<?php

namespace App\Payment\Admin\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Payment\Domain\Repositories\AdvertiserTransactionRepository;

class IndexAdvertisersTransactionsService extends Service
{
    protected $transactions;

    public function __construct(AdvertiserTransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function handle($data = [])
    {
        if (auth()->user()->can('index-all-transactions')) {
            return new GenericPayload($this->transactions->with('advertiser')->paginate(10));
        }
        return new UnauthorizedPayload();
    }
}
