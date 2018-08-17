<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable = ['id','name','active','categorie_id', ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function factura()
    {
        return $this->belongsToMany(Factura::class, 'resumen_facturas')->withPivot('factura_id');
    }


}
