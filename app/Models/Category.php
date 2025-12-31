<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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

    public static function ancestors($categoryId)
    {
        $ancestors = collect();
        $currentCategory = self::find($categoryId);


        if (!$currentCategory || $currentCategory->parent_id == 0) {
            return $ancestors;
        }

        while ($currentCategory && $currentCategory->parent_id != 0) {
            $parent = self::find($currentCategory->parent_id);

            if ($parent) {
                $ancestors->prepend($parent);
            }

            $currentCategory = $parent;
        }

        return $ancestors;
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
