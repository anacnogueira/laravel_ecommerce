<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Search extends Model
{
    protected $table = 'report_searches';
    
    const CREATED_AT = 'created';

    protected $fillable = [
        'keyword',
        'type',
        'ip',
    ];

     /**
     * Get the created date
     *
     * @param  string  scheduled date
     * @return string
     */
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
    }


    /**
     * Scope a query to only include website seaches.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query)
    {
        return $query->where('type', 'search');
    }
}
