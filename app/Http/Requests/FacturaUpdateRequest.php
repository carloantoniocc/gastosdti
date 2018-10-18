<?php

namespace GastosDTI\Http\Requests;


use GastosDTI\Factura;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;



class FacturaUpdateRequest extends FormRequest
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
            //'monto' => 'required|max:20|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
            'fecha_recepcion' => 'required|date_format:"Y-m-d',
            'active' => 'required'
        ];
    }

    public function updateFactura($factura)
    {
   
        $factura->provider_id = $this->jsonprovider_id;
        $factura->categorie_id = $this->jsoncategorie_id; 
        $factura->numero = $this->numero;
        $factura->fecha_recepcion = $this->fecha_recepcion;
        $factura->notacredito = $this->notacredito;
        $factura->active = $this->active;
        $factura->save();

        $items = $this->items;
        $factura->items()->sync($items);

    }




}
