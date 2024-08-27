<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
