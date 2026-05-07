<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Transaction extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'gateway',
        'contact_id',
        'transaction_id',
        'amount',
        'shipping_amount',
        'extras',
        'payment_method',
        'status',
        'payment_link'
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class,'contact_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
