<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Banner extends Model
{
    const CREATED_AT = 'created';

    protected $fillable = [
        'keyword',
        'type',
        'ip',
    ];
}
