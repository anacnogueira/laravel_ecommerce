<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'acronym',
        'code',
    ];
    
    public function states()
    {
        return $this->hasmany(State::class);
    }
}
