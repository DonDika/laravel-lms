<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Repositories\PricingRepository;
use App\Repositories\PricingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PricingRepositoryInterface::class, PricingRepository::class );
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
