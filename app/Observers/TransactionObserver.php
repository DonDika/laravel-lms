<?php

namespace App\Observers;

use App\Helpers\TransactionHelper;

class TransactionObserver
{
    public function creating($transaction)
    {
        $transaction->booking_trx_id = TransactionHelper::generatedUniqueTrxId();
    }
}


