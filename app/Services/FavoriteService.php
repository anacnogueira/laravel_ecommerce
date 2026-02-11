<?php
namespace App\Services;
use App\Repositories\Contracts\ProductContactRepositoryInterface;

class FavoriteService
{
    protected $productContactRepository;

    public function __construct(ProductContactRepositoryInterface $productContactRepository)
    {
        $this->productContactRepository = $productContactRepository;
    }

    public function returnShowCurrent($status, $productId, $url)
    {
        return view("components.show-current", compact("status","productId","url"));
    }

    public function favoriteStatusFromCustomerId($customerId, $productId)
    {
        if ($this->productContactRepository->favoriteStatusFromCustomerId($customerId, $productId))
            return 'N';

        return 'S';
    }

}
