<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReportSearch extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = null;

    protected $fillable = [
        'keyword',
        'type',
        'ip',
    ];

    /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }

}
