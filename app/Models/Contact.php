<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'type_person',
        'type_contact',
        'gender',
        'rg',
        'cpf',
        'date_birth',
        'email',
        'phone',
        'mobile'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
