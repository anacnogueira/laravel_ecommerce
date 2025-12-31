<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'product_id',
        'contact_id',
        'rate',
        'name',
        'email',
        'text',
        'status',
        'ip',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
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
}
