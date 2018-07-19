<?php

namespace GastosDTI;


use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
    	'numero','fecha',
    ];

    public function detallefactura(){
		$this->hasMany('app\DetalleFactura');
    }

    public function moneda(){
		$this->belongTo('app\Moneda');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }


}
