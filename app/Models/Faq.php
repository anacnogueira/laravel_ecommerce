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
   
    public function order()
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}
