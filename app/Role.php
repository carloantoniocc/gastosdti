<?php

namespace inicial;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
	/**
     * Funciones para determinar Usuarios asociados a un Rol
     */
	public function users()
    {
        return $this->belongsToMany('inicial\User');
    }
}
