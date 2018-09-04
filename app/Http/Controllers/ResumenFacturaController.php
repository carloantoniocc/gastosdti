<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\DetalleFactura;
use GastosDTI\ResumenFactura;
use GastosDTI\Factura;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ResumenFacturaController extends Controller
{


    public function cuadroresumen(Factura $factura)
    {
        if (Auth::check()) {
            return view('detallefacturas.detallegeneral',compact('factura'));      
        } else {
            return view('auth/login');
        }
    }



    public function borrar(ResumenFactura $resumen_factura)
    {
        
        if (Auth::check()) {

            DetalleFactura::destroy($resumen_factura->detallefactura->pluck('id')->toArray());
            $resumen_factura->resumen = NULL;
            $resumen_factura->resumen2 = NULL;
            $resumen_factura->monto = NULL;
            $resumen_factura->save();
            $factura = $resumen_factura->factura;
            $factura->actualizamonto($factura);
            
            
            return redirect()->route('cuadroresumen', ['factura' => $resumen_factura->factura])->with('message','delete');

        } else {
            return view('auth/login');
        }
    }



}
