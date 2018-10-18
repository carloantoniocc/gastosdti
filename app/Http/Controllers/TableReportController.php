<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\TableReport;
use GastosDTI\Comuna;
use GastosDTI\Factura;
use GastosDTI\Establecimiento;
use GastosDTI\Categorie;
use GastosDTI\DetalleFactura;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use Carbon\Carbon;

class TableReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comuna::select('id','name')->get();
        $categories = Categorie::select('id','name')->get();

        //$datos =    Factura::groupBY(DB::raw('year(fecha_recepcion)' ))
        //            ->selectRaw('year(fecha_recepcion) as fecha , sum(monto) as monto')->get();

        return view('tableReports.index',compact('categories','comunas'));
    }

    public function getEstablecimientos(Request $request,$id)
    {

        if ($request->ajax()){

            $establecimientos = Establecimiento::select('id','name','comuna_id','active')->where('comuna_id', '=', $id)
            ->orderBy('name')->get();
            return response()->json($establecimientos);
        }        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFormulario(Request $request)
    {

        $this->validate($request, [
            'fecha_inicio' => 'required|date_format:"Y-m-d',
            'fecha_termino' => 'required|date_format:"Y-m-d',
            'categorie' => 'required',
        ]);


        if ($request->has('comuna')  || $request->has('establecimiento') ) {

            $datos = DB::table('facturas')
                        ->selectRaw('year(facturas.fecha_recepcion) as fecha , sum(detalle_facturas.total) as monto')
                        ->join('resumen_facturas','facturas.id','=','resumen_facturas.factura_id')
                        ->join('detalle_facturas','resumen_facturas.id','=','detalle_facturas.resumen_factura_id')
                        ->where('categorie_id', $request->input('categorie'));
                        

            if ($request->has('comuna')) {
                $datos = $datos->where('comuna_id', '=', $request->input('comuna') );
            } 
            if ($request->has('establecimiento')) {
                $datos = $datos->where('establecimiento_id', '=', $request->input('establecimiento') );    
            }   
                       
            $datos = $datos->whereBetween('fecha_recepcion', [ $request->input('fecha_inicio') , $request->input('fecha_termino') ])
                           ->groupBY(DB::raw('year(facturas.fecha_recepcion)')) 
                           ->get(); 

        }else{    
        

            $datos = DB::table('facturas')
                        ->selectRaw('year(facturas.fecha_recepcion) as fecha , sum(facturas.monto) as monto')
                        ->where('categorie_id', $request->input('categorie'))  
                        ->whereBetween('fecha_recepcion', [ $request->input('fecha_inicio') , $request->input('fecha_termino') ])
                        ->groupBY(DB::raw('year(facturas.fecha_recepcion)'))
                        ->get(); 


        }            


        $categories = Categorie::all();            
        $comunas = Comuna::all();


        return view('/tablereports.index', compact('datos','comunas','categories'));

    }


/*    public function search(Request $request)
    {

        $comunas = Comuna::select('id','name')->get();
        $categories = Categorie::select('id','name')->get();

        return view('tableReports.index',compact('categories','comunas'));
    }*/


}
