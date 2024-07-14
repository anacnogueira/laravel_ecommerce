<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const CREATED_AT = "created";
    const UPDATED_AT = "modified";

    protected $fillable = [
        'code',
        'unity',
        'origin',
        'name',
        'description',
        'text',
        'cost_price',
        'selling_price',
        'minimum_stock',
        'maximum_stock',
        'current_stock',
        'column',
        'row',
        'sales',
        'status',
        'gross_weight',
        'highlight',
        'views',
        'last_view',
        'news',
        'permalink_old',
        'permalink',
        'meta_title',
        'length',
        'width',
        'height',
    ];
}
