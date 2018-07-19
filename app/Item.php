<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable = ['id','name','active','categorie_id', ];

    public function item()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function resumenfacturacion()
    {
        return $this->hasOne(ResumenFacturacion::class);
    }


}
