<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'url',
        'image',
        'dimension',
        'html',
        'expire_impressions',
        'expire_date',
        'scheduled_date',
        'status',       
    ];

    public function bannerLogs()
    {
        return $this->hasMany(BannerLog::class);
    }
}
