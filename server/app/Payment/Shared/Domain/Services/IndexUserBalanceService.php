<?php

namespace App\Payment\Sahred\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Payment\Domain\Repositories\BalanceRepository;

class IndexUserBalanceService extends Service
{
    protected $balance;

    public function __construct(BalanceRepository $balance)
    {
        $this->balance = $balance;
    }

    public function handle($data = [])
    {
        return new GenericPayload(auth()->user()->balance);
    }
}
