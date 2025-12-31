<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
    }

    /**
     * Get the modified date
     *
     * @param  string  expire date
     * @return string
     */
    public function getModifiedAttribute($value)
    {
         return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
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
            ->orderBy('name')
           ;
    }
}
