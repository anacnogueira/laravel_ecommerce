<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventDate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'satrt_date',
        'start_hour',
        'end_date',
        'end_hout',      
    ];

    public function event()
    {
        return $this->belongsTo(Country::class);
    }
}
