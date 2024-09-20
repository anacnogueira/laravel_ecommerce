<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SystemLog extends Model
{
    const CREATED_AT = 'created';

    protected $fillable = [
        'name',
        'user_id',
        'module_id',
        'user_ip',
        'operation',
        'description',   
    ];
}
