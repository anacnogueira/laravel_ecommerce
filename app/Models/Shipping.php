<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Shipping extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'description',
        'price',
        'delivery_time',
        'date_begin',
        'date_end',
        'status',
        'state_id',
        'city_id',
        'product_id',
        'total',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function dateBegin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

    protected function dateEnd(): Attribute
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
