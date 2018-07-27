<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Factura;
use GastosDTI\Provider;
use GastosDTI\Categorie;
use GastosDTI\Moneda;
use GastosDTI\ResumenFactura;

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

            $facturas = DB::table('facturas')
                        ->join('providers', 'facturas.provider_id', '=', 'providers.id')
                        ->join('categories', 'facturas.categorie_id', '=', 'categories.id')
                        ->select('facturas.id','facturas.numero','facturas.fecha_recepcion','facturas.monto','facturas.active','providers.name as proveedor','categories.name as categoria','facturas.montoresumen', 'facturas.notacredito')
                        ->orderby('facturas.fecha_recepcion')
                        ->paginate(20);


            return view('facturas.index', [
                'facturas'=> $facturas
            ]);
            
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

            $providers = Provider::all();
            $categories = Categorie::all();

            return view('facturas.create',compact('providers','categories')); 

        }else{

            return view('auth/login');
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

            $validator = validator::make($request->all(), [
                'provider_id' => 'required',
                'categorie_id' => 'required',
                'numero' => 'required|numeric|digits_between:1,9',
                'notacredito' => 'numeric|nullable|max:999999999',
                'monto' => 'required|max:20|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
                'fecha_recepcion' => 'required|date_format:"Y-m-d',
                'active' => 'required'
            ]);

            

            $categorie = Categorie::find($request->input('categorie_id'));
            $items = $categorie->items;

            $validator->after(function ($validator) use ($request,$items){
             
                if (count($items) == 0 ){
                    $validator->errors()->add('categorie_id', 'Categoria no posee items, favor ingresar.');                
                }

            });    


            if ($validator->fails()){

                return redirect('facturas/create')
                ->withErrors($validator)
                ->withInput();  

            }else{ 

                    $factura = new Factura;
                    $factura->provider_id =  $request->input('provider_id');
                    $factura->categorie_id = $request->input('categorie_id'); 
                    $factura->numero = $request->input('numero');
                    $factura->notacredito = $request->input('notacredito');
                    $factura->fecha_recepcion =  $request->input('fecha_recepcion');
                    $factura->monto =  $request->input('monto');
                    $factura->active =  $request->input('active');


                    if($factura->save()){

                        foreach ($items as $key => $item) {

                            $resumenfactura = new ResumenFactura;
                            $resumenfactura->item_id = $item->id;
                            $resumenfactura->factura_id = $factura->id;
                            $resumenfactura->save();

                        }
                           
                        return redirect('/facturas')->with('message','store'); 

                    }else{

                        //$validator->errors()->add('numero', 'Un error ha ocurrido al momento de registrar la Factura');
                    }
  

            }


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

            $provider = Provider::find($factura->provider_id);
            $categorie = Categorie::find($factura->categorie_id);

            return view('facturas.edit',compact('factura','provider', 'categorie'));

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
    public function update(Request $request,$id)
    {
        
        $validator = validator::make($request->all(), [
            'numero' => 'required|numeric|digits_between:1,9',
            'notacredito' => 'numeric|nullable|max:999999999',
            'monto' => 'required|max:20|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
            'fecha_recepcion' => 'required|date_format:"Y-m-d',
            'active' => 'required'
        ]);

        if ($validator->fails()){

            return redirect('/facturas/' . $id . '/edit')
            ->withErrors($validator)
            ->withInput();  

        }else{ 


            $factura = Factura::find($id);
            $factura->numero = $request->input('numero');
            $factura->fecha_recepcion =  $request->input('fecha_recepcion');
            $factura->monto =  $request->input('monto');
            $factura->notacredito =  $request->input('notacredito');
            $factura->active =  $request->input('active');
            $factura->save();           
    
            return redirect('/facturas')->with('message','update');  
        }

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
