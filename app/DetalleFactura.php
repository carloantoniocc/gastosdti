<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{

    protected $table = 'detalle_facturas';

    protected $fillable = [
        'descripcion', 'monto', 'pago_evento', 'renta', 'plazo', 'cuota',
    ];

    public function factura(){
       return $this->belongsto(Factura::class);
    }

    public function comuna(){
       return $this->belongsto(Comuna::class);
    }

    public function establecimiento(){
       return $this->belongsto(Establecimiento::class);
    }

    public function resumenfactura(){
       return $this->belongsto(ResumenFactura::class);
    }

       

}
