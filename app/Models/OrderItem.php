<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

    protected $fillable = [
        'value_unit',
        'value_total',
        'quantity',
        'gift',        
    ];

    public function order()
    {
        return $this->belongsTo(OrderPix::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(OrderPix::class, 'product_id');
    }
}
