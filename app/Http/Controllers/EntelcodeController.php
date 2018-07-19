<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Entelcode;
use GastosDTI\Establecimiento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class EntelcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $establecimientos = Establecimiento::paginate(10);

        return view('entelcodes.index', compact('establecimientos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editcode(Establecimiento $establecimiento)
    {

        return view('entelcodes.edit',compact('establecimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Entelcode  $entelcode
     * @return \Illuminate\Http\Response
     */
    public function show(Entelcode $entelcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Entelcode  $entelcode
     * @return \Illuminate\Http\Response
     */
    public function edit(Entelcode $entelcode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Entelcode  $entelcode
     * @return \Illuminate\Http\Response
     */
    public function updatecode(Request $request,Establecimiento $establecimiento)
    {


            $validator = validator::make($request->all(), [
                'entelcode' => 'required|string|max:150|unique:establecimientos',
            ],[

            'entelcode.unique' => 'El Código ya existe, favor revisar',
            
            ]);
            
            if ($validator->fails()) {

                            return back()
                                ->withErrors($validator)
                                ->withInput();
            }
            else {
                $establecimiento->entelcode = $request->input('entelcode');
                $establecimiento->save();

                return redirect('/entelcodes')->with('message','update');
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Entelcode  $entelcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entelcode $entelcode)
    {
        //
    }
}
