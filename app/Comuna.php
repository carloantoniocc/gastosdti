<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'comunas';

    protected $fillable = [
    	'codigo', 'name', 'rural', 'active'
    ];


}
