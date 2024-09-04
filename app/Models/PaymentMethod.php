<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'payment_gateway_id',
        'name',
        'value',
        'installments',
        'installments_interest_rate',
        'installments_min_value',
        'interest_rate',
        'image',
        'status',
        'html',
        'icon',
    ];
   
    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
