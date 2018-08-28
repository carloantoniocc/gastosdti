<?php

namespace GastosDTI;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Factura extends Model
{

    use SoftDeletes;  
    
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



}



