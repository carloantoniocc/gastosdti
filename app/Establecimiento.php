<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    public function comuna()
    {
        return $this->hasMany('GastosDTI\Comuna');
    }
	
	public function tipo()
    {
        return $this->hasMany('GastosDTI\TipoEstab');
    }
	
	/**
     * Funciones para determinar Usuarios asociados a un Establecimiento
     */
	public function users()
    {
        return $this->belongsToMany('GastosDTI\User');
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


	public static function establecimientosxcomuna($id){
		return Establecimiento::where('comuna_id','=',$id);
	}


	public function establecimiento()
	{
		return $this->hasOne('GastosDTI\Establecimiento');
	}

}
