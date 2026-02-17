<?php
namespace App\Services;


class StarRatingService
{
    protected $stars;

    public function __construct()
    {
        $this->stars = [
            0 => "Selecione a nota",
            5 => "Excelente",
            4 => "Muito bom",
            3 => "Mediano",
            2 => "Ruim",
            1 => "Péssimo",
        ];
    }

    public function averageProductRated($averageRate)
    {
        $stars = $this->stars;

        return view("components.rated", compact("stars","averageRate"));
    }

    public function rate($productId, $comments)
    {
        $stars = $this->stars;

        return view("components.rate", compact("stars","productId", "comments"));
    }
}
