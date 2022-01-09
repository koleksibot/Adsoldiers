<?php

namespace App\Payment\Shared\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Payment\Domain\Repositories\SoldierTransactionRepository;

class CancelTransactionService extends Service
{
    protected $transactions;

    public function __construct(SoldierTransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function handle($transaction = [])
    {
        if ($transaction->status === 'canceled' || $transaction->status === 'done') {
            return new GenericPayload([
                'message' => 'This transaction already ' . $transaction->status . '!'
            ]);
        }

        if (auth()->user()->can('cancel-transaction', $transaction) && $transaction->status === 'pending') {
            $transaction->update(['status' => 3]);
            return new GenericPayload([
                'message' => 'This transaction has been canceled!',
                'transactions' => $this->transactions->with('soldier')->paginate(10)
            ]);
        }

        return new UnauthorizedPayload(['message' => 'You are not allowed to cancel this transaction']);
    }
}
