<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class TipoEstab extends Model
{
    protected $fillable = [
			'id','name','active','created_at','updated_at',     	
    ];
}
