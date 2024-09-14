<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserGroup extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',       
        'status',
        'permissions',     
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
