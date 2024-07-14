<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'contact_id',
        'contact_address_id',
        'invoice',
        'tracking_code',
        'value',
        'value_shipping',
        'value_discount',
        'value_total',
        'type_shipping',
        'shipping_modality_id',
        'delivery_time',
        'payment_method',
        'payment_method_id',
        'obs',
        'installments',
        'order_status_id',
        'viewed',
        'trash',
    ];

    public function order()
    {
        return $this->belongsTo(OrderPix::class, 'order_id');
    }
}
