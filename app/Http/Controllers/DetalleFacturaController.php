<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\DetalleFactura;
use GastosDTI\Provider;
use GastosDTI\Factura;
use GastosDTI\Comuna;
use GastosDTI\Establecimiento;
use GastosDTI\Categorie;
use GastosDTI\Storage;
use GastosDTI\ResumenFactura;
use GastosDTI\Item;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class DetalleFacturaController extends Controller
{


    public function detalleitem(ResumenFactura $resumen_factura)
    {

        if (Auth::check()) {

            $detallefacturas = $resumen_factura->detallefactura;

            switch ($resumen_factura->item->storage->codigo) {
                case 'STG01':
                    return view('detallefacturas.serviciosdelcontrato',compact('detallefacturas'));
                    break;
                case 'STG02':
                    return view('detallefacturas.serviciosadicionales',compact('detallefacturas'));
                    break;
            }  

        } else {
            return view('auth/login');
        } 

    }


}