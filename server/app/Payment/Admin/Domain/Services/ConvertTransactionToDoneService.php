<?php

namespace App\Payment\Admin\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Payment\Domain\Repositories\SoldierTransactionRepository;

class ConvertTransactionToDoneService extends Service
{
    protected $transactions;

    public function __construct(SoldierTransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function handle($data = [], $transaction = [])
    {
        if ($transaction->soldier->balance <= 0) {
            return new GenericPayload(['message' => 'You Wallet Is Empty!']);
        }

        if ($transaction->status === 'done') {
            return new GenericPayload(['message' => 'This transaction already Done!']);
        }

        if (auth()->user()->can('done-transaction', $transaction)) {
            $newBalance = $transaction->soldier->balance - $transaction->amount;

            if ($newBalance < 0) {
                return new GenericPayload(['message' => 'You Dont Have Enough Money!']);
            }

            $transaction->soldier()->update(['balance' => $newBalance]);
            $transaction->update([
                'status' => 2,
                'balance' => $newBalance,
                'transNumber' => $data['transNumber']
            ]);
            return new GenericPayload([
                'message' => 'This transaction has been done successfully!',
                'transactions' => $this->transactions->with('soldier')->paginate(10)
            ]);
        }

        return new UnauthorizedPayload([
            'message' => 'You are not allowed to do this action'
        ]);
    }
}
