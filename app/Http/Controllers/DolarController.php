<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Dolar;
use GastosDTI\Provider;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class DolarController extends Controller
{
    /**
     * Display a listing of the resource. Mostrar una lista del recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dolars = Dolar::select('id','fecha','valor','active')->orderBy('fecha')->paginate(10);
        return view('dolars.index',compact('dolars'));

    }

    /**
     * Show the form for creating a new resource. Mostrar el formulario para crear un nuevo recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dolars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $dolar = new Dolar;
        $dolar->fecha = $request->input('fecha');
        $dolar->valor = $request->input('valor');
        $dolar->active = $request->input('active');
        $dolar->save();

        return redirect('/dolars')->with('message','store');

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Dolar  $dolar
     * @return \Illuminate\Http\Response
     */
    public function show(Dolar $dolar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Dolar  $dolar
     * @return \Illuminate\Http\Response
     */
    public function edit(Dolar $dolar)
    {
        return view('dolars.edit', compact('dolar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Dolar  $dolar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dolar $dolar)
    {
        
        $dolar->fecha = $request->input('fecha');
        $dolar->valor = $request->input('valor');
        $dolar->active = $request->input('active');

        $dolar->save();

        return redirect('/dolars')->with('message','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Dolar  $dolar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dolar $dolar)
    {
        //
    }

    public function getcmdolar()
    {

        return view('dolars.carga_masivadolar');
    }


    public function postimportar(Request $request)
    {

         $file = $request->file('file');
         $nombre = $file->getClientOriginalName();

         \Storage::disk('local')->put($nombre,  \File::get($file));


        Excel::load('storage/app/' . $nombre, function($archivo)
          {

           
           $result=$archivo->get();
            
           foreach($result as $key => $value)
           {
            $dolar = new Dolar;
            $dolar->fecha = $value->fecha;
            $dolar->valor = $value->valor;
            $dolar->save();
           }
          })->get();

        return redirect('/dolars')->with('message','store');
    }

}
