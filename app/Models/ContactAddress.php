<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactAddress extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'contact_id',
        'title',
        'cep',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city_id',
        'state_id',
        'country_id',
        'phone',
        'contact',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
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

    /**
     * Get the modified date
     *
     * @param  string  expire date
     * @return string
     */
    public function getModifiedAttribute($value)
    {
         return $value ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }
}
