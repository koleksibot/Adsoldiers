<?php

namespace App\PaymentMethods\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\PaymentMethods\Domain\Repositories\PaymentMethodRepository;

class IndexUserBalanceService extends Service
{
    protected $paymentmethods;

    public function __construct(PaymentMethodRepository $paymentmethods)
    {
        $this->paymentmethods = $paymentmethods;
    }

    public function handle($data = [])
    {
        return new GenericPayload([
            'balance' => auth()->user()->balance
        ]);
    }
}
