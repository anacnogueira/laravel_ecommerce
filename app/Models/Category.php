<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'image',
        'parent_id',
        'order',
        'status',
        'short_description',
        'text',
        'permalink_old',
        'permalink',
        'created',
        'modified'
    ];

    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->select('id','name','parent_id','permalink')
            ->orderBy('order');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 4, 'children')))
            ->select('id','name','parent_id','permalink')
            ->where('status','S')
            ->where('parent_id','=', 0)
            ->orderBy('order')
            ->get();
    }
}