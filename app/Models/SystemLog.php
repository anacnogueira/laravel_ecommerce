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

    /**
     * Scope a query to only include 24 hours of logs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLast24Hours($query)
    {
       return $query->where('created', ">=", Carbon::now()->subDay());
    }
}
