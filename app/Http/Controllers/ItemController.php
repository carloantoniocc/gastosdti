<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Item;
use GastosDTI\Categorie;
use GastosDTI\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use GastosDTI\Http\Requests\ItemStoreRequest;

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
        if (Auth::check()) {
            $items = Item::with('categorie','storage')->orderBy('name','ASC')->paginate();
            return view('items.index',compact('items'));
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
        if (Auth::check()) {
            $categories = Categorie::select('id','name')->where('active','=','1')->orderBy('name','ASC')->get();
            $storages = Storage::orderBy('name','ASC')->get(); 

            return view('items.create',compact('items','categories','storages'));      

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
    public function store(ItemStoreRequest $request)
    {

        if (Auth::check()) {
            
            $request->createItem();
            return redirect('items')->with('message','store');    

        }else{
            return view('auth/login');
        }

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
        
        if (Auth::check()) {
            $categories = Categorie::orderBy('name','ASC')->get();
            $storages = Storage::orderBy('name','ASC')->get(); 

            return view('items.edit',compact('categories','item','storages'));

        }else{
            return view('auth/login');
        }           
        
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
