<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
