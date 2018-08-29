<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ResumenFactura extends Model
{
   
    use SoftDeletes;   
    
    protected $table = 'resumen_facturas';

    protected $fillable = [
    	'item_id','factura_id','resumen','monto','active',
    ]; 


    public function factura(){
        return $this->belongsTo(Factura::class);
    }  

    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function detallefactura()
    {
        return $this->hasMany(DetalleFactura::class);
    }    


}
