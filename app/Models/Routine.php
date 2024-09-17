<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'description',
        'module_id',
        'page',
        'onclick',
        'quantity',
        'visible',
        'order',
        'btn_image',
        'show',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
