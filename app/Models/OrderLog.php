<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderLog extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = null;

    protected $fillable = [
        'order_id',
        'order_status_id',
        'comment',
        'client_notified',
        'client_comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
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
     * Get the Client Notified Text
     *
     * @param  string  client_notified
     * @return string
     */
    public function getClientNotifiedAttribute($value)
    {
        return $value  == 'S' ? 'Sim' : 'Não';
    }

     /**
     * Get the Client Notified Text
     *
     * @param  string  client_comment
     * @return string
     */
    public function getClientCommentAttribute($value)
    {
        return $value  == 'S' ? 'Sim' : 'Não';
    }
}
