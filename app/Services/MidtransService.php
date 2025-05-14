<?php

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class MidtransService {


    public function __construct()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }
    
    // $params berisi informasi, menerima informasi dari PaymentService berupa produk apa, paket langganan apa dll
    public function createSnapToken(Array $params)
    {
        try {
            // lalu akan tersimpan di server midtrans
            return Snap::getSnapToken($params);
        } catch(\Exception $exception) {
            Log::error('Failed to create Snap token: ' . $exception->getMessage());
            throw $exception;
        }
    }

    // akan diberikan ke PaymentService, untuk melakukan pembuatan transaksi di db 
    public function handleNotification()
    {
        try {
            $notification = new Notification();
            return [
                'order_id' => $notification->order_id,
                'transaction_status' => $notification->transaction_status,
                'gross_amount' => $notification->groos_amount,
                'custom_field1' => $notification->custom_field1, // userid
                'custom_field2' => $notification->custom_field2  // pricingid, untuk mengetahui notifikasi ini untuk transaksi yg mana
            ];
        } catch (\Exception $exception) {
            Log::error('Midtrans notification error: ' . $exception->getMessage());
            throw $exception;
        }
    }

}