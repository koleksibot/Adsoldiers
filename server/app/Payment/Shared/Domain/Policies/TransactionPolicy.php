<?php

namespace App\Payment\Shared\Domain\Policies;

use App\Users\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function cancelTransaction(User $user, $transaction)
    {
        if (
               $user->id === $transaction->soldier()->first()->id ||
               $user->roles()->first()->slug === 'admin'
            ) {
            return true;
        }

        return false;
    }

    public function doneTransaction(User $user, $transaction)
    {
        if ($user->roles()->first()->slug === 'admin') {
            return true;
        }

        return false;
    }

    public function IndexAllTransactions(User $user)
    {
        return $user->hasRole('index-all-transactions');
    }
}
