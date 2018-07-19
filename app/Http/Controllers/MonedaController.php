<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Moneda;
use Illuminate\Http\Request;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monedas = Moneda::Select('id','name','active')->orderBy('name')->paginate(10);
        return view('monedas.index',compact('monedas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monedas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $moneda = new Moneda;
        $moneda->name = $request->input('name');
        $moneda->active = $request->input('active');

        $moneda->save();

        return redirect('/monedas')->with('message','store');

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function show(Moneda $moneda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function edit(Moneda $moneda)
    {
        return view('monedas.edit',compact('moneda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moneda $moneda)
    {
        
        $moneda->name = $request->input('name');
        $moneda->active = $request->input('active');

        $moneda->save();

        return redirect('/monedas')->with('message','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moneda $moneda)
    {
        //
    }
}
