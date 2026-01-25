<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Coupon extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
       'name',
       'description',
       'code',
       'discount_type',
       'discount_amount',
       'total_amount',
       'customer_login',
       'free_shipping',
       'from_date',
       'to_date',
       'uses_per_coupon',
       'uses_per_customer',
       'status',
    ];

    public function products()
    {
        return $this->belongsTo(CouponProduct::class);
    }

    public function categories()
    {
        return $this->belongsTo(CouponCategory::class);
    }

    public function histories()
    {
        return $this->belongsTo(CouponHistory::class);
    }

    protected function fromDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

    protected function toDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

    protected function createdFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                isset($attributes['created']) ? \Carbon\Carbon::parse($attributes['created'])->format('d/m/Y H:i:s') : null,
        );
    }

    protected function modified(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : null,
        );
    }
}
