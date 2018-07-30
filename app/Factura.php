<?php

namespace GastosDTI;


use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
    	'numero','fecha', 'provider'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }


}
