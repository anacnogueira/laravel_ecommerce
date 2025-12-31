<?php
namespace App\Services;

class FavoriteService
{

    public function returnShowCurrent($status, $productId, $url)
    {
        return view("components.show-current", compact("status","productId","url"));
    }

}
