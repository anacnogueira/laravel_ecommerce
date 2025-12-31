<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

    protected $fillable = [
        'product_id',
        'percent_promotion',
        'price_promotion',
        'status',
        'black_friday',
        'date_initial',
        'date_final',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
