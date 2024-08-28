<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'permalink',
        'description',
        'excerpt',
        'image',
        'value',
        'vacancies',
        'cep',
        'address',       
        'number',
        'complement',
        'country_id',
        'state_id',
        'city_id',
        'shom_map',
        'show_link_map',
        'professional_name',
        'professional_curriculum',
        'professional_photo',
        'status',
    ];

    public function eventDates()
    {
        return $this->hasMany(EventDate::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

   
}
