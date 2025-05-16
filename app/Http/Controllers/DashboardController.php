<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }


    public function subscription()
    {
        $transaction = $this->transactionService->getUserTransactions();
        return view('front.subscription',compact('transaction'));
    }


    public function subscriptionDetail(Transaction $transaction)
    {
        return view('front.subscription_detail', compact($transaction));
    }


    
}
