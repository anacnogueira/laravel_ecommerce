<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'neighborhood',
        'country_id',
        'state_id',
        'city_id',
        'show_map',
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

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
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

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? number_format($value, 2, ',', '.') : '',
        );
    }


}
