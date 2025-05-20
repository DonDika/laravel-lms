<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Services\PaymentService;
use App\Services\PricingService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    protected $pricingService;
    protected $paymentService;
    protected $transactionService;

    public function __construct(
        PricingService $pricingService,
        PaymentService $paymentService,
        TransactionService $transactionService
    )
    {
        $this->pricingService = $pricingService;
        $this->paymentService = $paymentService;
        $this->transactionService = $transactionService;
    }


    public function index()
    {
        return view('front.index');
    }


    // paket langganan
    public function pricing()
    {
        $pricingPackages = $this->pricingService->getAllPackages(); //ambil semua package yg tersedia
        $user = Auth::user();
        return view('front.pricing', compact('pricingPackages', 'user'));
    }


    public function checkout(Pricing $pricing)
    {
        $checkoutData = $this->transactionService->prepareCheckout($pricing);
        if ($checkoutData['alreadySubscribed']) {
            return redirect()->route('front.pricing')->with('error', 'You are already subscribed to this plan');
        }
        return view('front.checkout', $checkoutData); // tidak perlu pakai compact lagi karena return dari TransactionService sudah berupa compact
    }


    public function paymentStoreMidtrans()
    {
        try {
            $pricingId = session()->get('pricing_id'); // ambil pricing_id dari session
            if(!$pricingId){
                return response()->json(['error' => 'No pricing data found in the session.'], 400);
            }

            $snapToken = $this->paymentService->createPayment($pricingId); // create snap token
            if(!$snapToken){
                return response()->json(['error' => 'Failed to create Midtrans transacation.'], 500);
            }

            return response()->json(['snap_token' => $snapToken], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'Payment failed: ' . $exception->getMessage()], 500);
        }
    }


    public function paymentMidtransNotification(Request $request)
    {
        try {
            $transactionStatus = $this->paymentService->handlePaymentNotification();
            if(!$transactionStatus){
                return response()->json(['error' => 'Invalid notification data'], 400);
            }
            return response()->json(['status' => $transactionStatus], 200); // transaksi berhasil dibuat di database
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Failed to process notification'], 500);
        }
    }


    public function checkoutSuccess()
    {
        $pricing = $this->transactionService->getRecentPricing();
        if(!$pricing){
            return redirect()->route('front.pricing')->with('error', 'No recent subscribtion found.');
        }

        return view('front.checkout_success', compact('pricing'));

    }    

    
}
