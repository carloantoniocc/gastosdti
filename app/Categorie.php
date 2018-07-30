<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id','name','active'
    ];


    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }  


    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

}
