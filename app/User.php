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
        'name', 'email', 'password', 'validate',
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
	 * Funcion para el filtro de usuarios
	 */
	public function scopeSearch($query,$search) {
		if( trim($search) != "" ){
			$query->where('email', "LIKE", "%$search%");
		}
	}

	/**
     * Funciones para determinar Roles de Usuario
     */
	public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
	
	public function isRole($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
			if ($role->rol == $roleName)
            {
                return true;
            }
        }

        return false;
    }
	
	/**
     * Funciones para determinar Establecimientos de Usuario
     */
	public function establecimientos()
    {
        return $this->belongsToMany('App\Establecimiento');
    }
	
	public function isEstab($estabName)
    {
        foreach ($this->establecimientos()->get() as $estab)
        {
			if ($estab->name == $estabName)
            {
                return true;
            }
        }

        return false;
    }	
}
