<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class CouponHistory extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = null;

    protected $fillable = [
       'coupon_id',
       'order_id',
       'contact_id',
       'ip',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    protected function createdFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                isset($attributes['created']) ? \Carbon\Carbon::parse($attributes['created'])->format('d/m/Y H:i:s') : null,
        );
    }

}
