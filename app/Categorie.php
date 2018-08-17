<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;
    
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

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'categorie_provider')->withPivot('provider_id');
    }




}
