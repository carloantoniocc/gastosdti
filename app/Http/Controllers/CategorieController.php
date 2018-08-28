<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Categorie;
use GastosDTI\Item;
use GastosDTI\Moneda;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        //Controladores de usuarios
        $this->middleware('admin');
                
    } 


    public function index()
    {

        if (Auth::check()) {

            $categories = Categorie::paginate();
            return view('categories.index',compact('categories'));

        } else {
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

            $monedas = Moneda::all();
            return view('categories.create',compact('monedas'));

        } else {
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

            $this->validate($request, [

                'name' => 'required|string|max:150|unique:categories',
                'moneda_id' => 'required',
                'titulo1' => 'string|max:30',
                'titulo2' => 'string|max:30',

            ]);
            
                $categorie = new Categorie;
                $categorie->name = $request->input('name');    
                $categorie->active = $request->input('active');
                $categorie->moneda_id = $request->input('moneda_id');
                $categorie->titulo1 = $request->input('titulo1');
                $categorie->titulo2 = $request->input('titulo2');
                $categorie->save(); 
                return redirect('/categories')->with('message','store'); 

        } else {

            return view('auth/login');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

        if (Auth::check()) {

            $categorie = Categorie::find($id);
            $monedas = Moneda::all();
            return view('categories.edit',compact('categorie','monedas'));

        } else {
            return view('auth/login');
        }


    }


    public function edititem($id)
    {

        $item = Item::find($id);
        return view('categories.edititem',compact('item'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */

    public function postupdateitem(Request $request, $id)
    {

        if (Auth::check()) {


            $this->validate($request, [
                'name' => 'required|string|max:150',
            ]);
            
                $item = Item::find($id);
                $item->name = $request->input('name');
                $item->active = $request->input('active');
                $item->save();    

                return redirect('/categories/showcategorie/' . $item->categorie_id)->with('message','update');

        } else {
            return view('auth/login');
        }                

    }

    public function update(Request $request, Categorie $categorie,$id)
    {


        if (Auth::check()) {

            $this->validate($request, [
                'name' => 'required|string|max:150',
                'moneda_id' => 'required',
                'titulo1' => 'string|max:150',
                'titulo2' => 'string|max:150',

            ]);
            

                $categorie = Categorie::find($id);
                $categorie->name = $request->input('name');
                $categorie->active = $request->input('active');
                $categorie->moneda_id = $request->input('moneda_id');
                $categorie->titulo1 = $request->input('titulo1');
                $categorie->titulo2 = $request->input('titulo2');                
                $categorie->save();    

                return redirect('/categories')->with('message','update');

        } else {
            return view('auth/login');
        } 

    }



    public function showcategorie(Categorie $categorie)
    {
        
        $items = $categorie->items;
        return view('items.crearitems', compact('categorie'));

    }    



}
