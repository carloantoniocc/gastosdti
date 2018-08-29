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
        $this->belongsto(Factura::class);
    }

    public function comuna(){
        $this->belongsto(Comuna::class);
    }

    public function establecimiento(){
        $this->belongsto(Establecimiento::class);
    }

    public function resumenfactura(){
        $this->belongsto(ResumenFactura::class);
    }
        

}
