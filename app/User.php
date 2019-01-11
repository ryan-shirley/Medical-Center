<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
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
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Check that user has specific role
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->first() != null;
    }

    /**
     * The patient that belong to the user.
     */
    public function patient() {
        return $this->hasOne('App\Patient');
    }

    /**
     * The doctor that belongs to the user.
     */
    public function doctor() {
        return $this->hasOne('App\Doctor');
    }
}
