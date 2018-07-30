<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'name',
    ];

    public function facturas()
    {
    	return $this->hasMany(Factura::class);
    }

}
