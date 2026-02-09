<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class ProductPromotion extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

    protected $fillable = [
        'product_id',
        'percent_promotion',
        'price_promotion',
        'status',
        'black_friday',
        'date_initial',
        'date_final',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function dateInitial(): Attribute
    {
        return Attribute::make(
            //get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

    protected function dateFinal(): Attribute
    {
        return Attribute::make(
            //get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
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

    public function getPromotion($product)
    {

        $promotions = [];

        if ($product->promotions) {
            foreach ($product->promotions as $i => $promotion) {
                if ($promotion->status == 'S'){
                    $start = $promotion->date_initial;
                    $end   = $promotion->date_final;
                    if ($this->validateDate($start, $end)) {
                        $promotions = $promotion;
                    }
                }
            }
        }

        return $promotions;
    }

    protected function validateDate($start, $end)
    {
        $today = date('Y-m-d');

        return (
            (empty($start) && empty($end)) ||
            ($start <= $today && empty($end)) ||
            (empty($start) && $end >= $today) ||
            ($start <= $today && $end >= $today)
        );
    }
}
