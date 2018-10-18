<?php

namespace GastosDTI;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Factura extends Model
{

    use SoftDeletes;  
    
    protected $table = 'facturas';

    protected $fillable = [
    	'numero','fecha', 'provider','provider_id','fecha_recepcion','categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'resumen_facturas')->withPivot('item_id');
    }

    public function IsItem($item_id)
    {

        foreach ($this->resumenFacturas as $item)
        {
            if ($item->item_id == $item_id)
            {
                return true;
            }
        }

        return false;

    }

    public function resumenfacturas()
    {
        return $this->hasMany(ResumenFactura::class);
    }

    public function actualizamonto(Factura $factura)
    {
        $factura->monto = $factura->resumenfacturas->sum('monto');
        $factura->save();


    }

    public function scopeFiltracategoria($query, $categorie)
    {
        $query->where('categorie_id', $categorie);   
    }

    public function scopeFiltrafechas($query, $inicio, $termino)
    {
        $query->whereBetween('fecha_recepcion', [ $inicio , $termino ]);   
    }

    public function scopeTipobusqueda($query, $comuna, $establecimiento)
    {

        if (empty($comuna) && empty($establecimiento) ) {

            $query->groupBY(DB::raw('year(fecha_recepcion)' ))
                  ->selectRaw('year(fecha_recepcion) as fecha , sum(monto) as monto');      
        }else{
            
            

        }


    }


}



