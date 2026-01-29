<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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

    public function customer()
    {
        return $this->belongsTo(Contact::class,'contact_id');
    }

    public function address()
    {
        return $this->belongsTo(ContactAddress::class, 'contact_address_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class, 'order_id');
    }

    public function orderPix()
    {
        return $this->hasOne(OrderPix::class, 'order_id');
    }

    /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    protected function createdFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                isset($attributes['created']) ? \Carbon\Carbon::parse($attributes['created'])->format('d/m/Y H:i') : null,
        );
    }
}
