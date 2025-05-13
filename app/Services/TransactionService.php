<?php 

namespace App\Services;

use App\Models\Pricing;
use App\Models\Transaction;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionService {

    protected $pricingRepository;
    protected $transactionRepository;


    public function __construct(
        PricingRepositoryInterface $pricingRepositoryInterface,
        TransactionRepositoryInterface $transactionRepositoryInterface,
    ){
        $this->pricingRepository = $pricingRepositoryInterface;
        $this->transactionRepository = $transactionRepositoryInterface;
    }



    // menampilkan data ke checkout page
    // tanpa repository
    // menerima pricing melalui model binding
    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubscribed = $pricing->isSubscribedByUser($user->id); // cek apakah subscribtion yg sama masih aktif 

        $tax = 0.11;
        $totalTaxAmount = $pricing->price * $tax;
        $subTotalAmount = $pricing->price;
        $grandTotalAmount = $subTotalAmount + $totalTaxAmount;

        // kalkulasi berapa lama subscribe
        $startedAt = now();
        $endedAt = $startedAt->copy()->addMonths($pricing->duration);

        // simpan pricing_id ke session karna akan dibutuhkan untuk transaksi di midtrans
        session()->put('pricing_id',$pricing->id);

        // return ke controller
        return compact(
            'totalTaxAmount',
            'grandTotalAmount',
            'subTotalAmount',
            'priicing',
            'user',
            'alreadySubscribed',
            'startedAt',
            'endedAt'
        );
    }

    public function getRecentPricing()
    {
        $pricingId = session()->get('pricing_id'); // ambil dari session yg telah disimpan
        return $this->pricingRepository->findById($pricingId); //menggunakan repository
        
        //return Pricing::find($pricingId); // melakukan data akses layer langsung di service, tanpa repository
    }

    // manampilkan history subscribtion user
    public function getUserTransactions()
    {
        $user = Auth::user();
        return $this->transactionRepository->getUserTransactions($user->id); // menggunakan repository

        // n+1 query
        // data akses layer di dalam service, tanpa repository
        // return Transaction::with('pricing')
        //     ->where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }


}