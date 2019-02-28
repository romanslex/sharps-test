<?php

namespace Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ADMIN_ID = 1;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'balance', 'is_banned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function outboundTransactions()
    {
        return $this->hasMany(Transaction::class, 'payer_id');
    }

    public function inboundTransactions()
    {
        return $this->hasMany(Transaction::class, 'recipient_id');
    }

    public function scopeAllExceptAdmin(Builder $q)
    {
        return $q->where('id', '!=', self::ADMIN_ID)->get();
    }

}
