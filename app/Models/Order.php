<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

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

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function orderItens()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function orderLogs()
    {
        return $this->hasOne(OrderPix::class, 'order_id');
    }

    public function orderPix()
    {
        return $this->hasOne(OrderPix::class, 'order_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
