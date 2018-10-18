<?php

namespace GastosDTI\Http\Requests;

use GastosDTI\Factura; 

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class FacturaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'jsonprovider_id' => 'required',
                'jsoncategorie_id' => 'required',
                'items' => 'required',
                'numero' => 'required|numeric|digits_between:1,9',
                'notacredito' => 'numeric|nullable|max:999999999',
                'fecha_recepcion' => 'required|date_format:"Y-m-d',
                'active' => 'required'
        ];
    }


    public function createFactura()
    {

        DB::transaction(function () {
            
                $factura = Factura::create([
                    'provider_id' =>  $this->jsonprovider_id,
                    'categorie_id' => $this->jsoncategorie_id,
                    'numero' => $this->numero,
                    'notacredito' => $this->notacredito,
                    'fecha_recepcion' =>  $this->fecha_recepcion,
                    'active' => $this->active,

                ]);

                $items = $this->items;
                $factura->items()->sync($items);



        });

    }

}
