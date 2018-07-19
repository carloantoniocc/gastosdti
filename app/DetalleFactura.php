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
        $this->belongsto('app\Factura');
    }

    public function comuna(){
        $this->belongsto('app\Comuna');
    }

    public function establecimiento(){
        $this->belongsto('app\establecimiento');
    }

}
