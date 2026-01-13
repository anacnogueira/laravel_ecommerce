<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'fantasy_name',
        'type_person',
        'type_contact',
        'gender',
        'rg',
        'cpf',
        'cnpj',
        'ie',
        'im',
        'business_type',
        'date_birth',
        'email',
        'website',
        'phone',
        'mobile',
        'password',
        'newsletter',
        'image',
        'description',
        'url',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function address()
    {
        return $this->hasMany(ContactAddress::class);
    }

    public function info()
    {
        return $this->hasMany(ContactInfo::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function newsletter()
    {
        return $this->hasOne(ContactNewsletter::class);
    }

    public function log()
    {
        return $this->hasOne(ContactLog::class);
    }

    /**
     * Set the scheduled date
     *
     * @param  string  $value
     * @return void
     */
    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = $value ?
        Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') :
        null;
    }

     /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    public function getDateBirthAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
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
         return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
    }


    /**
     * Scope a query to only include suppliers.
     */
    #[Scope]
    protected function suppliers(Builder $query): void
    {
        $query->where('type_contact', 'provider');
    }

    /**
     * Scope a query to only include partners.
     */
    #[Scope]
    protected function partners(Builder $query): void
    {
        $query->where('type_contact', 'partner');
    }


     /**
     * Scope a query to only include customers (clients).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomers($query)
    {
        return $query->where('type_contact', 'client')->get();
    }
}
