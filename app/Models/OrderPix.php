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
        'qrcode',
        'due_date',
        'e2eid',
        'verified',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
