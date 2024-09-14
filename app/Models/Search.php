<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    const CREATED_AT = 'created';

    protected $fillable = [
        'keyword',
        'type',
        'ip',
    ];

    /**
     * Scope a query to only include website seaches.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query)
    {
        return $query->where('type', 'search>');
    }
}
