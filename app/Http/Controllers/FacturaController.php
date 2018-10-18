<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Factura;
use GastosDTI\Provider;
use GastosDTI\Categorie;
use GastosDTI\Moneda;
use GastosDTI\ResumenFactura;
use GastosDTI\Item;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Rule;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use GastosDTI\Http\Requests\FacturaStoreRequest;
use GastosDTI\Http\Requests\FacturaUpdateRequest;


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
            $facturas = Factura::with('provider','categorie')->paginate();
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
            $providers = Provider::has('categories')->where('active', '1')->get();
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
    public function store(FacturaStoreRequest $request)
    {

        if (Auth::check()) {
            $request->createFactura();
            return redirect('/facturas')->with('message','store');                 
        } else {
            return view('auth/login');
        }
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
            $providers = Provider::has('categories')->where('active', '1')->get();
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
    public function update(FacturaUpdateRequest $request, Factura $factura)
    {

        if (Auth::check()) {
            $request->updateFactura($factura);
            return redirect('/facturas')->with('message','update');  
        }else{

            return view('auth/login');
        }
    }


}
