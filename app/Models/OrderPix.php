<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPix extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'txid',
        'qrcode_image',
        'due_date',
        'e2eid',        
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
