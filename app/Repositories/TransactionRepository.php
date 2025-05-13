<?php  

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    // gak dipake
    public function findByBookingId(string $bookingId): Transaction
    {
        return Transaction::where('booking_trx_id', $bookingId)->first();
    }
    
    // akan diterapkan di service yg lain
    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    
    public function getUserTransactions(int $userId): Collection
    {
        return Transaction::with('pricing')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }



}