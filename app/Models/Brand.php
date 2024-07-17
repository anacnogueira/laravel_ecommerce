<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
    public static function menu()
    {
        return static::select('id','name','permalink')
            ->where('status','S')
            ->orderBy('name')
            ->get();
    }
}