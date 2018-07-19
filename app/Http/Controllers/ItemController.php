<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Item;
use GastosDTI\Categorie;
use GastosDTI\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
   

    public function __construct()
    {
        $this->middleware('auth');
        //Controladores de usuarios
        $this->middleware('admin');
                
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = DB::table('categories')
        ->join('items', 'items.categorie_id','=','categories.id')
        ->join('storages','storages.id','=','items.storage_id')
        ->where('categories.active','=',1) 
        ->select('items.id as id','items.name as name', 'items.active as active', 'categories.name as categoria','storages.name as storage')->get();
        
        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $items = Item::select('id','name')->where('active','=','1')->get();
            $categories = Categorie::select('id','name')->where('active','=','1')->get();
            $storages = Storage::all(); 

            return view('items.create',compact('items','categories','storages'));      
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

        $item = new Item;
        $item->name = $request->input('name');
        $item->active = $request->input('active');
        $item->categorie_id = $request->input('categorie_id');
        $item->storage_id = $request->input('storage_id');
        $item->save();

        return redirect('items')->with('message','store');

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    public function showcategorie($id)
    {
        $items = Item::select('id','name','active')->where('categorie_id','=',$id)->get();
        return view('items.asociaritems',compact('items'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Item $item)
    {

        $categories = Categorie::all();
        $storages = Storage::all(); 

        return view('items.edit',compact('categories','item','storages'));
        
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Item  $item
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request,Item $item)
    {
        
        
        $item->name = $request->input('name');
        $item->active = $request->input('active');
        $item->categorie_id = $request->input('categorie_id');
        $item->storage_id = $request->input('storage_id');
        $item->save();
        return redirect('/items')->with('message','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
