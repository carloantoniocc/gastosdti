<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Factura;
use GastosDTI\Provider;
use GastosDTI\Categorie;
use GastosDTI\Moneda;
use GastosDTI\ResumenFactura;
use GastosDTI\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        if (Auth::check()) 
        {
            $facturas = Factura::paginate();
            return view('facturas.index', compact('facturas'));
        }else{
            return view('auth/login');
        }

    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::check()) 
        {
            $providers = Provider::has('categories')->get();
            return view('facturas.create',compact('providers')); 
        }else{

            return view('auth/login');
        }
    }


    public static function getItems(Categorie $categorie)
    {
        
        if ( request()->ajax() ){
            
            return response()->json($categorie->items);

        }


    }


    public static function getCategories(Provider $provider)
    {

        if ( request()->ajax() ){
            
            return response()->json($provider->categories);

        }


    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (Auth::check()) {

            $this->validate($request, [
                'jsonprovider_id' => 'required',
                'jsoncategorie_id' => 'required',
                'items' => 'required',
                'numero' => 'required|numeric|digits_between:1,9',
                'notacredito' => 'numeric|nullable|max:999999999',
                //'monto' => 'required|max:20|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
                'fecha_recepcion' => 'required|date_format:"Y-m-d',
                'active' => 'required'
            ]);

                $factura = new Factura;
                $factura->provider_id =  $request->input('jsonprovider_id');
                $factura->categorie_id = $request->input('jsoncategorie_id'); 
                $factura->numero = $request->input('numero');
                $factura->notacredito = $request->input('notacredito');
                $factura->fecha_recepcion =  $request->input('fecha_recepcion');
                //$factura->monto =  $request->input('monto');
                $factura->active =  $request->input('active');
                $factura->save();

                $items = $request->input('items');
                $factura->items()->sync($items);

                return redirect('/facturas')->with('message','store');                 

        } else {

            return view('auth/login');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {


        if (Auth::check()) {

            $providers = Provider::has('categories')->get();
            return view('facturas.edit',compact('factura','providers'));

        }else{

            return view('auth/login');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {

            $this->validate($request, [
                'jsonprovider_id' => 'required',
                'jsoncategorie_id' => 'required',
                'items' => 'required',
                'numero' => 'required|numeric|digits_between:1,9',
                'notacredito' => 'numeric|nullable|max:999999999',
                //'monto' => 'required|max:20|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
                'fecha_recepcion' => 'required|date_format:"Y-m-d',
                'active' => 'required'
            ]);

            $factura->provider_id =  $request->input('jsonprovider_id');
            $factura->categorie_id = $request->input('jsoncategorie_id'); 
            $factura->numero = $request->input('numero');
            $factura->fecha_recepcion =  $request->input('fecha_recepcion');
            //$factura->monto =  $request->input('monto');
            $factura->notacredito =  $request->input('notacredito');
            $factura->active =  $request->input('active');
            $factura->save();

            $items = $request->input('items');
            $factura->items()->sync($items);


            return redirect('/facturas')->with('message','update');  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }


}
