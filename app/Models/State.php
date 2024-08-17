<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'uf',
    ];

    public function state()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasmany(City::class);
    }
}
