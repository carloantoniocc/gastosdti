<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\TableReport;
use GastosDTI\Comuna;
use GastosDTI\Factura;
use GastosDTI\Establecimiento;
use GastosDTI\Categorie;
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
        $comunas = Comuna::all();
        $categories = Categorie::all();

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
    public function consulta(Request $request)
    {


        $this->validate($request, [
            'fecha_inicio' => 'required|date_format:"Y-m-d',
            'fecha_termino' => 'required|date_format:"Y-m-d',
            'categorie' => 'required',
        ]);

        //$datos = Factura::filtracategoria($request->input('categorie'))->get();

        

            $datos = Factura::filtracategoria($request->input('categorie'))
                        ->filtrafechas( $request->input('fecha_inicio') , $request->input('fecha_termino') )
                        ->tipobusqueda( $request->input('comuna') , $request->input('establecimiento') )
                        ->get();

        if ($request->has('establecimiento')) {

            $datos1 = Factura::filtracategoria($request->input('categorie'))
                        ->filtrafechas( $request->input('fecha_inicio') , $request->input('fecha_termino') )
                        ->groupBY(DB::raw('year(fecha_recepcion)' ))
                        ->selectRaw('year(fecha_recepcion) as fecha , sum(monto) as monto')->get();


        }else{    
        
            $datos1 = Factura::filtracategoria($request->input('categorie'))
                        ->filtrafechas( $request->input('fecha_inicio') , $request->input('fecha_termino') )
                        ->groupBY(DB::raw('year(fecha_recepcion)' ))
                        ->selectRaw('year(fecha_recepcion) as fecha , sum(monto) as monto')->get();
        }            


        $categories = Categorie::all();            
        $comunas = Comuna::all();

        return view('/tableReports.index', compact('datos','comunas','categories'));

    }



}
