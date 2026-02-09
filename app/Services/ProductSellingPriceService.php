<?php
namespace App\Services;


class ProductSellingPriceService
{

    public function returnPrices($sellingPrice, $pricePromotion = null)
    {
        $installment = $sellingPrice / 3;
        $sellingPrice = number_format($sellingPrice,2,',','.');

        if ($pricePromotion) {
            $installment = $pricePromotion/3;
            $pricePromotion = number_format($pricePromotion,2,',','.');

        }

        $installment = number_format($installment,2,',','.');

        return view("components.selling-promotion-product-price", compact('sellingPrice','pricePromotion', 'installment'));
    }

}
