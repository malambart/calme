<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Updater;

class User extends Authenticatable
{
    use Updater;
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
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function giveRoleTo(Role $role)
    {
        return $this->roles()->attach($role);
    }
    public function isSuperAdmin()
    {
        if ($this->id==1) {
            return true;
        }
    }

}
