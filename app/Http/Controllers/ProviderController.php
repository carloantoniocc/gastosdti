<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $providers = Provider::select('id','name','rut','active')->orderBy('name')->paginate(10);
            
            return view('providers.index',compact('providers'));
        }
        else {
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
        if (Auth::check()) {
            return view('providers.create');      
        }
        else {
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
            // validate
            $validator = validator::make($request->all(), [
                'name' => 'required|string|max:150|unique:providers',
            ]);
            
            if ($validator->fails()) {
                return redirect('providers/create')
                            ->withErrors($validator)
                            ->withInput();
            }
            else {


                $provider = new Provider;

                $provider->name = $request->input('name');
                $provider->rut = $request->input('rut');
                $provider->active = $request->input('active');
            
                $provider->save();            

                return redirect('/providers')->with('message','store');
            }
        }
        else {
            return view('auth/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
       
        if (Auth::check()) {
            
            return view('providers.edit',compact('provider'));
        }
        else {
            return view('auth/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {

        if (Auth::check()) {
            // validate
            $validator = validator::make($request->all(), [
                'name' => 'required|string|max:150|unique:providers,name,'.$provider->id,
            ]);
            
            if ($validator->fails()) {
                return redirect('providers/'.$provider->id.'/edit')
                            ->withErrors($validator)
                            ->withInput();
            }
            else {
                $provider = Provider::find($provider->id);
                
                $provider->name = $request->input('name');
                $provider->rut = $request->input('rut');
                $provider->active = $request->input('active');
            
                $provider->save();            
                
                return redirect('/providers')->with('message','update');
            }
        }
        else {
            return view('auth/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
