<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'url',
        'image',
        'dimension',
        'html',
        'expire_impressions',
        'expire_date',
        'scheduled_date',
        'status',       
    ];

    public function bannerLogs()
    {
        return $this->hasMany(BannerLog::class);
    }

    public static function show()
    {   
        $banners =  static::select('id','name','url','image', 'dimension', 'html', 'scheduled_date', 'expire_date')
            ->where('status','S')
            ->where(function($query){
                $today = date('Y-m-d');
                $query->orWhere(function($query){
                    $query->where('scheduled_date', null)
                          ->where('expire_date', null);
                }) 
                ->orWhere(function( $query) use ($today){
                    $today = date('Y-m-d');
                    $query->where('scheduled_date', '<=', $today)
                          ->where('expire_date', null);
                })
                ->orWhere(function($query) use ($today){
                    $query->where('scheduled_date', null)
                          ->where('expire_date', "=>", $today);
                })
                ->orWhere(function($query) use ($today){
                    $query->where('scheduled_date', "<=", $today)
                          ->where('expire_date', "=>", $today);
                });
            })                      
            ->limit(4)
            ->inRandomOrder()
            ->get();
        return $banners;        
    }
}
