<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PaymentMethod extends Model
{
    public $timestamps = false;

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

    protected function interestRate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? number_format($value, 2, ',', '.') : '',
            set: fn ($value) => $value ? number_format(floatval($value), 2, '.', ',') : null,
        );
    }
}
