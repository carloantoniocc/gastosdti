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

    public function items()
    {
        return $this->belongsToMany(Item::class, 'resumen_facturas')->withPivot('item_id');
    }

    public function IsItem($nameitem)
    {

        foreach ($this->items as $item)
        {
            if ($item->name == $nameitem)
            {
                return true;
            }
        }

        return false;

    }

}
