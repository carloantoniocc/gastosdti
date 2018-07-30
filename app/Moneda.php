<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{

    protected $fillable = [
    	'id','name',
    ];	
    
    public function categoria()
    {
		return $this->belongTo(Categorie::class);
    }	


}
