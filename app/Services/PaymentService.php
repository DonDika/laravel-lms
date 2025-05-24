<?php 

namespace App\Services;

use App\Models\Pricing;
use App\Services\MidtransService;
use App\Helpers\TransactionHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class PaymentService  
{
    protected $midtransService;
    protected $pricingRepository;
    protected $transactionRepository;

    public function __construct(
        MidtransService $midtransService,
        PricingRepositoryInterface $pricingRepositoryInterface,
        TransactionRepositoryInterface $transactionRepositoryInterface
    )
    {
        $this->midtransService = $midtransService;
        $this->pricingRepository = $pricingRepositoryInterface;
        $this->transactionRepository = $transactionRepositoryInterface;
    }


    // untuk membuat data transaksi baru, ke dalam snap token, di server midtrans 
    public function createPayment(int $pricingId)
    {
        $user = Auth::user();
        $pricing = $this->pricingRepository->findById($pricingId); //repository // minta/ambil datanya melalui repo dan dijadikan variable
        //$pricing = Pricing::findOrFail($pricingId); //model

        $tax = 0.11;
        $totalTax = $pricing->price * $tax; // data yg diminta lalu diolah
        $grandTotal = $pricing->price + $totalTax;

        // data transaction
        $params = [
            'transaction_details' => [
                'order_id' => TransactionHelper::generatedUniqueTrxId(), // generate random transaction code
                'gross_amount' => (int) $grandTotal //memastikan value-nya int
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email
            ],
            'item_details' => [
                [
                    'id' => $pricing->id,
                    'price' => (int) $pricing->price,
                    'quantity' => 1,
                    'name' => $pricing->name
                ],
                [
                    'id' => 'tax',
                    'price'=> (int) $totalTax,
                    'quantity' => 1,
                    'name' => 'PPN 11%'

                ]
            ],
            'custom_field1' => $user->id,
            'custom_field2' => $pricingId  //transaksi ini akan dibikin ketika transaksi sudah berhasil, untuk membuat transaksi terbaru
        ];

        return $this->midtransService->createSnapToken($params);
    }


    // untuk menerima apabila transaksi tersebut berhasil dibuat di server midtrans
    public function handlePaymentNotification()
    {
        $notification = $this->midtransService->handleNotification();

        if (in_array($notification['transaction_status'],['capture','settlement'])){
            // $pricing = Pricing::findOrFail($notification['custom_field2']); // langsung ke model
            $pricing = $this->pricingRepository->findById($notification['custom_field2']); // repository
            $this->createTransaction($notification, $pricing); // bikin data transaksi baru, data transaksi tidak akan terbikin di db apabila pembayaran belum selesai/belum sukses
        }

        return $notification['transaction_status'];
    }


    // create transaction to db
    protected function createTransaction(array $notification, Pricing $pricing)
    {
        $startedAt = now();
        $endedAt = $startedAt->copy()->addMonths($pricing->duration);

        // parsing data from midtrans & pricing to transaction
        $transactionData = [
            'user_id' => $notification['custom_field1'],
            'pricing_id' => $notification['custom_field2'],
            'sub_total_amount' => $pricing->price,
            'total_tax_amount' => $pricing->price * 0.11,
            'grand_total_amount' => $notification['gross_amount'],
            'payment_type' => 'Midtrans',
            'is_paid' =>  true,
            'booking_trx_id' => $notification['order_id'],
            'started_at' => $startedAt,
            'ended_at' => $endedAt
        ];

        $this->transactionRepository->create($transactionData);

        Log::info('Transaction successfully created: ' . $notification['order_id']);
    }

}