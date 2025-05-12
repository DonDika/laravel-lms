<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // jadi ketika aplikasinya pertama kali dijalankan.., sebuah konsep seperti Dependency Injection
    // Tempat observer
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
    }
}
