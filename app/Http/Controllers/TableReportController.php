<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\TableReport;
use GastosDTI\Comuna;
use GastosDTI\Establecimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        $datos = DB::table('facturas')
                    ->join('resumen_facturas','resumen_facturas.factura_id','=','facturas.id')
                    ->select('facturas.fecha_recepcion as fecha', DB::raw('sum(resumen_facturas.monto) as monto'))
                    ->groupBY('facturas.fecha_recepcion')
                    ->get();

        return view('tableReports.index',compact('comunas','datos'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $comunas = Comuna::select('id','name','active')->orderBy('name')->get();


        if ($request->has('establecimiento')) {



        $datos = DB::table('facturas')
                    ->join('resumen_facturas','resumen_facturas.factura_id','=','facturas.id')
                    ->join('detalle_facturas','detalle_facturas.resumen_id','=','resumen_facturas.id')
                    ->join('establecimientos','establecimientos.id','=','detalle_facturas.establecimiento_id')
                    ->where('detalle_facturas.establecimiento_id','=',$request->establecimiento)
                    ->select('facturas.fecha_recepcion as fecha' ,DB::raw('sum(detalle_facturas.total) as monto'))
                    ->groupBY('facturas.fecha_recepcion')
                    ->get();

            
        }else{

 

        $datos = DB::table('facturas')
                    ->join('resumen_facturas','resumen_facturas.factura_id','=','facturas.id')
                    ->join('detalle_facturas','detalle_facturas.resumen_id','=','resumen_facturas.id')                            
                    ->join('comunas','comunas.id','=','detalle_facturas.comuna_id')
                    ->join('establecimientos','establecimientos.id','=','detalle_facturas.establecimiento_id')
                    ->where('detalle_facturas.comuna_id','=',$request->comuna)
                    ->select('facturas.fecha_recepcion as fecha',   DB::raw('sum(detalle_facturas.total) as monto'))
                    ->groupBY('facturas.fecha_recepcion')
                    ->get();


        }            

        return view('/tableReports.index', compact('datos','comunas'));

    }


    public function ver(Request $request)
    {
        dd('ver');

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\TableReport  $tableReport
     * @return \Illuminate\Http\Response
     */
    public function show(TableReport $tableReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\TableReport  $tableReport
     * @return \Illuminate\Http\Response
     */
    public function edit(TableReport $tableReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\TableReport  $tableReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableReport $tableReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\TableReport  $tableReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableReport $tableReport)
    {
        //
    }
}
