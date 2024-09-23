<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SystemLog extends Model
{
    const CREATED_AT = 'created';

    protected $fillable = [
        'name',
        'user_id',
        'module_id',
        'user_ip',
        'operation',
        'description',   
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


     /**
     * Get the scheduled date
     *
     * @param  string  scheduled date
     * @return string
     */
    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i') : null;
    }

     /**
     * Get the scheduled date
     *
     * @param  string  scheduled date
     * @return string
     */
    public function getOperationAttribute($value)
    {
        switch($value) {
            case 'create':
                return 'Criação';
           case 'update':
                return 'Atualização';
            case 'delete':
                return 'Exclusão';
            default:
                return 'Desconhecida';        
        }
    }


    /**
     * Scope a query to only include 24 hours of logs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLast24Hours($query)
    {
       return $query->where('created', ">=", Carbon::now()->subDay());
    }
}
