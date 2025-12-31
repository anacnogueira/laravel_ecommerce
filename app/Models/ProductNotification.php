<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductNotification extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'product_id',
        'name',
        'email',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
