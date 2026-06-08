<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Brand extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'status',
        'image',
        'status',
        'short_description',
        'text',
        'permalink_old',
        'permalink',
    ];

    protected function createdFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                isset($attributes['created']) ? \Carbon\Carbon::parse($attributes['created'])->format('d/m/Y H:i') : null,
        );
    }

    protected function modified(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Carbon::parse($value)->format('d/m/Y H:i') : null
        );
    }

    public static function menu()
    {
        return static::select('id','name','permalink')
            ->where('status','S')
            ->orderBy('name')
            ->get();
    }

    public static function activeBrands()
    {
        return static::select('*')
            ->where('status','S')
            ->orderBy('name');
    }
}
