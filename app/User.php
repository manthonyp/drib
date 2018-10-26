<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
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
     * Check if signed in user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {        
        return $this->type === self::ADMIN_TYPE;    
    }

    /**
     * Assign relationship
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            $user->posts()->delete();
        });
    }
}
