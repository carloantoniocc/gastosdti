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


    public function create(Request $request)
    {
        
        
        if (Auth::check()) 
        {
        
            $establecimientos = Establecimiento::select('id','code','name','active')->orderBy('name')->get();
            return view('detallefacturas.create',compact('comunas','establecimientos'));      
        }
        else 
        {
            return view('auth/login');
        }

    }

    public function store(Request $request)
    {

         dd($request);   
         $file = $request->file('file');
         $nombre = $file->getClientOriginalName();

         \Storage::disk('local')->put($nombre,  \File::get($file));


        Excel::load('storage/app/' . $nombre, function($archivo)
          {
           $result=$archivo->get();
         
           foreach($result as $key => $value)
           {
            dd($value->id. $value->nombre);
           }
          })->get();
 
         
        return redirect('/detallefacturas/1/detalle')->with('message','store');
        
    }


    public function edit(DetalleFactura $detalleFactura, $id)
    {

        if (Auth::check()) {
            $detallefactura = DetalleFactura::find($id);
            $comunas = Comuna::select('id','name','active')->orderBy('name')->get();
            $establecimientos = Establecimiento::select('id','code','name','active')->orderBy('name')->get();            

            
            return view('detallefacturas.edit',compact('detallefactura','comunas','establecimientos'));
        }
        else {
            return view('auth/login');
        }

    }


    public function update(Request $request, DetalleFactura $detalleFactura)
    {

            
            $detalleFactura->descripcion = $request->input('descripcion');
            $detalleFactura->monto = $request->input('monto');
            $detalleFactura->establecimiento_id = $request->input('establecimiento_id');
            $detalleFactura->comuna_id = $request->input('comuna_id');
            $detalleFactura->factura_id = 1;

            $detalleFactura->pago_evento = 0;
            $detalleFactura->renta = 0;
            $detalleFactura->plazo = 0;
            $detalleFactura->cuota = 0;
        
            $detalleFactura->save();           
            
            return redirect('/detalleFactura')->with('message','update');

    }



    public function detallegeneral(Factura $factura)
    {

        if (Auth::check()) {

            return view('detallefacturas.detallegeneral',compact('factura'));      

        } else {
            return view('auth/login');
        }

    }
    

    public function detalledelete(ResumenFactura $resumenfactura)
    {
        dd($resumenfactura);

    }

    public function detalleitem($idresumenfactura)
    {

        
        $resumenfactura = ResumenFactura::find($idresumenfactura);
        $item = Item::find($resumenfactura->item_id);

        $detalles = DB::table('resumen_facturas')
            ->join('detalle_facturas','resumen_facturas.id', '=', 'detalle_facturas.resumen_id')
            ->join('establecimientos', 'establecimientos.id', '=' , 'detalle_facturas.establecimiento_id' )
            ->where('resumen_facturas.id', '=' , $idresumenfactura )
            ->select('establecimientos.name as establecimiento', 
                'detalle_facturas.id as iddetalle' , 
                'detalle_facturas.active as active' , 
                'detalle_facturas.cantidad as cantidad' ,
                'detalle_facturas.valorunitario as valorunitario' ,
                'detalle_facturas.servicio as servicio' ,
                'detalle_facturas.pagounico as pagounico' ,
                'detalle_facturas.rentamensual as rentamensual' ,
                'detalle_facturas.plazo as plazo' ,
                'detalle_facturas.iniciocobro as iniciocobro' ,
                'detalle_facturas.cuota as cuota' ,
                'detalle_facturas.total as total' 
            )->paginate(20);
 

        $codigo = $item->storage->codigo;

        switch ($codigo) {
            case 'STG01':
                return view('detallefacturas.serviciosdelcontrato',compact('detalles'));
                break;
            case 'STG02':
                return view('detallefacturas.serviciosadicionales',compact('detalles'));
                break;
            case '':
                echo "i es igual a 2";
                break;
        }  

    }


}