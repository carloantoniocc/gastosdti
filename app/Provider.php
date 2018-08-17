<?php

namespace GastosDTI;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'name', 'rut',
    ];

    public function facturas()
    {
    	return $this->hasMany(Factura::class);
    }

    public function categories()
    {
    	return $this->belongsToMany(Categorie::class, 'categorie_provider')->withPivot('categorie_id');
    }

    
    public function isCategorie($categorieName)
    {
        foreach ($this->categories()->get() as $categorie)
        {
            if ($categorie->name == $categorieName)
            {
                return true;
            }
        }

        return false;
    }

}
