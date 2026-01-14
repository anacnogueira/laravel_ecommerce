<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
    }

    /*
     * Get the Value Formated
     *
     * @param  string  expire date
     * @return string

    public function getValueAttribute($value)
    {
        return number_format($value,2,",",".");
    }

    /**
     * Get the Value Shipping Formated
     *
     * @param  string  expire date
     * @return string

    public function getValueShippingAttribute($value)
    {
        return number_format($value,2,",",".");
    }


     * Get the Value Discount Formated
     *
     * @param  string  expire date
     * @return string

    public function getValueDiscountAttribute($value)
    {
        return number_format($value,2,",",".");
    }


     * Get the Value Total Formated
     *
     * @param  string  expire date
     * @return string

    public function getValueTotalAttribute($value)
    {
        return number_format($value,2,",",".");
    }
    */
}
