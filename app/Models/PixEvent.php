<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PixEvent extends Model
{
    protected $fillable = [
        'e2eid',
        'txid',
        'event',
    ];
}
