<?php

namespace inicial;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    public function comuna()
    {
        return $this->hasMany('inicial\Comuna');
    }
	
	public function tipo()
    {
        return $this->hasMany('inicial\TipoEstab');
    }
	
	/**
     * Funciones para determinar Usuarios asociados a un Establecimiento
     */
	public function users()
    {
        return $this->belongsToMany('inicial\User');
    }
	
	/**
	 * Funcion que retorna el nombre del establecimiento
	 * @param: id
	 * @return: nombre de establecimiento (string)
	 */
	public function nombreEstablecimiento($id)
	{
		return Establecimiento::select('name')->where('id',$id);
	}
}
