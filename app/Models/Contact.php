<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\ContactResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Contact extends Authenticatable
{
    use Notifiable, CanResetPassword;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'fantasy_name',
        'type_person',
        'type_contact',
        'gender',
        'rg',
        'cpf',
        'cnpj',
        'ie',
        'im',
        'business_type',
        'date_birth',
        'email',
        'website',
        'phone',
        'mobile',
        'password',
        'newsletter',
        'image',
        'description',
        'url',
        'status',
        'privacy',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ContactResetPasswordNotification($token));
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function address()
    {
        return $this->hasMany(ContactAddress::class);
    }

    public function info()
    {
        return $this->hasMany(ContactInfo::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function newsletter()
    {
        return $this->hasOne(ContactNewsletter::class);
    }

    public function log()
    {
        return $this->hasOne(ContactLog::class);
    }

    /**
     * Define como o campo date_birth será manipulado.
     */
    protected function dateBirth(): Attribute
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


    /**
     * Scope a query to only include suppliers.
     */
    #[Scope]
    protected function suppliers(Builder $query): void
    {
        $query->where('type_contact', 'provider');
    }

    /**
     * Scope a query to only include partners.
     */
    #[Scope]
    protected function partners(Builder $query): void
    {
        $query->where('type_contact', 'partner');
    }


     /**
     * Scope a query to only include partners.
     */
    #[Scope]
    protected function customers(Builder $query): void
    {
        $query->where('type_contact', 'client');
    }
}
