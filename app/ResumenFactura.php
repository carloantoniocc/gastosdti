<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class ResumenFactura extends Model
{
   
    protected $table = 'resumen_facturas';

    protected $fillable = [
    	'item_id','factura_id','resumen','monto','active',
    ]; 


}
