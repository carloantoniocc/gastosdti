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
        $this->belongsTo('app\Moneda');
    }  


    public function factura()
    {
        return $this->hasOne(Factura::class);
    }

}
