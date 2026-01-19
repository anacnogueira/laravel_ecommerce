<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'status',
        'icon',
        'description',
        'order',
        'parent_id',
        'slug',
    ];

    public function parent()
    {
        return $this->hasOne(Module::class,'id','parent_id');
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

    public function children()
    {
        return $this->hasMany(Module::class,'parent_id','id')
            ->select('id','name','icon', 'parent_id','slug')
            ->where('status','S')
            ->orderBy('order');
    }


    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 4, 'children')))
            ->select('id','name','icon', 'parent_id','slug')
            ->where('status','S')
            ->where('parent_id','=', 0)
            ->orderBy('order')
            ->get();
    }
}
