<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BannerLog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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

    protected function scheduledDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn (?string $value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

    protected function expireDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn (?string $value) => $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null,
        );
    }

     /**
     * Get the created date
     *
     * @param  string  expire date
     * @return string
     */
    protected function createdFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                isset($attributes['created']) ? \Carbon\Carbon::parse($attributes['created'])->format('d/m/Y H:i') : null,
        );
    }

    protected function modified(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Carbon::parse($value)->format('d/m/Y H:i') : null
        );
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
                          ->where('expire_date', ">=", $today);
                });
            })
            ->limit(4)
            ->inRandomOrder()
            ->get();
        return $banners;
    }
}
