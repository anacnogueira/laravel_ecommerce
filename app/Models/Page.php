<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Page extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    
    protected $fillable = [
        'title',
        'description',
        'permalink',
        'content',
        'status',
        'show_in_menu',
        'date_initial',
        'date_final',
    ];

    /**
     * Set the inital date
     *
     * @param  string  $value
     * @return void
     */
    public function setDateInitialAttribute($value)
    {
        $this->attributes['date_initial'] = $value ?
        Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') :
        null;
    }

    /**
     * Set the final date
     *
     * @param  string  $value
     * @return void
     */
    public function setDateFinalAttribute($value)
    {
        $this->attributes['date_final'] = $value ?
        Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') :
        null;
    }

    /**
     * Get the initial date
     *
     * @param  string  scheduled date
     * @return string
     */
    public function getDateInitialAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    /**
     * Get the expire date
     *
     * @param  string  expire date
     * @return string
     */
    public function getDateFinalAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->permalink = $model->permalink ?:Str::slug($model->title, '-');
        });
    }
}
