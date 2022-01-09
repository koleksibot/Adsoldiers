<?php

namespace App\Payment\Advertiser\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Payment\Domain\Repositories\SoldierTransactionRepository;
use App\Payment\Domain\Repositories\AdvertiserTransactionRepository;

class StoreTransactionService extends Service
{
    protected $advertiserTransaction;
    protected $soldierTransaction;

    public function __construct(AdvertiserTransactionRepository $advertiserTransaction, SoldierTransactionRepository $soldierTransaction)
    {
        $this->advertiserTransaction = $advertiserTransaction;
        $this->soldierTransaction = $soldierTransaction;
    }

    public function handle($data = [])
    {
        $userRole = auth()->user()->roles()->first()->slug;

        if ($userRole === 'advertiser') {
            $data['advertiser_id'] = auth()->user()->id;
            $this->advertiserTransaction->create($data);
        }

        if ($userRole === 'soldier') {
            $data['soldier_id'] = auth()->user()->id;
            $this->soldierTransaction->create($data);
        }
        return new GenericPayload(['message' => 'Transaction has completed successfully!']);
    }
}
