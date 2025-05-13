<?php 

namespace App\Services;

use App\Models\Pricing;
use App\Repositories\PricingRepositoryInterface;

class PricingService {

    protected $pricingRepository;

    public function __construct(PricingRepositoryInterface $pricingRepositoryInterface){
        $this->pricingRepository = $pricingRepositoryInterface;
    }

    // mengambil seluruh data di table Pricing
    // melalui repository
    public function getAllPackages()
    {
        return $this->pricingRepository->getAllPackages();
    }


    // langsung hit ke model
    // public function getAllPackages() 
    // {
    //     return Pricing::all();
    // }
    


}
