<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PaymentGateway extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'status',
        'html',   
    ];
}
