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
        'brand_id',
        'contact_id',
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function contacts()
    {
        return $this->hasMany(ProductContact::class);
    }

    public function promotions()
    {
        return $this->hasMany(ProductPromotion::class);
    }

    public function notifications()
    {
        return $this->hasMany(ProductNotification::class);
    }

    public function scopeHighlight($query)
    {
        return $query->where('status', 'S')
        ->where('current_stock', '>',0)
        ->where('highlight','S')
        ->inRandomOrder()
        ->limit(12)
        ->get();
    }
}
