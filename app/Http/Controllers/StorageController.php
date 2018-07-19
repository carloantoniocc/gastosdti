<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Storage;
use GastosDTI\Item;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storages = Storage::all();

        return view('storages.index',compact('storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('storages.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $storage = new Storage;
        $storage->name = $request->input('name');
        $storage->codigo = $request->input('codigo');
        $storage->active = $request->input('active');


        $storage->save();
        return redirect('/storages')->with('message','store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {

        return view('storages.edit',compact('storage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        
        $storage->name = $request->input('name');
        $storage->codigo = $request->input('codigo');
        $storage->active = $request->input('active');
        $storage->save();

        return redirect('/storages')->with('message','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        //
    }



}
