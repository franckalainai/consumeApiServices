<?php
namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketService{
    use consumesExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses;

    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

    public function getProducts(){
        return $this->makeResquest('GET', 'products');
    }

    public function getProduct($id){
        return $this->makeResquest('GET', "products/{$id}");
    }

    public function getCategories(){
        return $this->makeResquest('GET', 'categories');
    }

}
