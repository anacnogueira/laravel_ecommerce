<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductContact extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'contact_id',
        'email',
        'type',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
