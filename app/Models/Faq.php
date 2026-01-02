<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'question',
        'answer',
        'status',
        'order',
    ];

    public static function active()
    {
        return static::select('id','question', 'answer', 'order')
            ->where('status','S')
            ->orderBy('order');
    }
}
