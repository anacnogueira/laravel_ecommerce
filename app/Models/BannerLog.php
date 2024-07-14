<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerLog extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'views',
        'clicks',    
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
