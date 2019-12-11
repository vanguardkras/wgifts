<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
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

    /**
     * Get the gift lists of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function giftLists()
    {
        return $this->hasMany('App\GiftList');
    }

    /**
     * Check if current user has admin rights.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->id === 1 ? true : false;
    }
}
