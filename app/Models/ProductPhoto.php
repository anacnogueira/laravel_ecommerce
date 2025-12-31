<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'photo_ori',
        'width_original',
        'height_original',
        'photo_redim',
        'width_redim',
        'height_redim',
        'order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
