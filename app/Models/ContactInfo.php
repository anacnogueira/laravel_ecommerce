<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactInfo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'name',
        'sector',
        'email',
        'phone',
        'branch_line',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
