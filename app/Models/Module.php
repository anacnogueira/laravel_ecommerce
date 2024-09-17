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
}
