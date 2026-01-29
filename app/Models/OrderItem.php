<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

    protected $fillable = [
        'order_id',
        'product_id',
        'value_unit',
        'value_total',
        'quantity',
        'gift',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    public function getValueUnitAttribute($value)
    {
        return number_format($value,2,",",".");
    }

}
