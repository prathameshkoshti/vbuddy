<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function announcements()
    {
        return $this->hasMany('App\Announcement', 'id');
    }

    public function placements()
    {
        return $this->hasMany('App\Announcement', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\Announcement', 'id');
    }
}
