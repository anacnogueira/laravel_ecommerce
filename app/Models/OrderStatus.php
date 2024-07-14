<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'value',
        'comment',
        'order_status',
    ];
   
    public function order()
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}
