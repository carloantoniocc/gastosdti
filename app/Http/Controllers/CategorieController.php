<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Categorie;
use GastosDTI\Item;
use GastosDTI\Moneda;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $categories = DB::table('categories')
        ->join('monedas','monedas.id','=','categories.moneda_id')
        ->select('categories.id as id','categories.name as name', 'categories.active as active','monedas.name as moneda')->paginate(10);

        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $monedas = Moneda::all();
        return view('categories.create',compact('monedas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $validator = validator::make($request->all(), [
                'name' => 'required|string|max:150|unique:categories',
                'moneda_id' => 'required',
                'descripcion' => 'required|string|max:150'

            ]);
            
            if ($validator->fails()) {
                return redirect('categories/create')
                            ->withErrors($validator)
                            ->withInput();
            }
            else {

                $categorie = new Categorie;
                $categorie->name = $request->input('name');    
                $categorie->descripcion = $request->input('descripcion');    
                $categorie->active = $request->input('active');
                $categorie->moneda_id = $request->input('moneda_id');
                $categorie->save(); 
                return redirect('/categories')->with('message','store'); 
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
    public function edit(Categorie $categorie, $id)
    {
        $categorie = Categorie::find($id);
        $monedas = Moneda::all();
        return view('categories.edit',compact('categorie','monedas'));
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

            $validator = validator::make($request->all(), [
                'name' => 'required|string|max:150',
            ]);
            
            if ($validator->fails()) {
                return redirect('categories/update')
                            ->withErrors($validator)
                            ->withInput();
            }
            else {

                $item = Item::find($id);
                $item->name = $request->input('name');
                $item->active = $request->input('active');
                $item->save();    

                return redirect('/categories/showcategorie/' . $item->categorie_id)->with('message','update');
            }

    }

    public function update(Request $request, Categorie $categorie,$id)
    {
        
            $validator = validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'moneda_id' => 'required',
                'descripcion' => 'required|string|max:150',

            ]);
            
            if ($validator->fails()) {
                return redirect('categories/create')
                            ->withErrors($validator)
                            ->withInput();
            }
            else {

                $categorie = Categorie::find($id);
                $categorie->name = $request->input('name');
                $categorie->descripcion = $request->input('descripcion');
                $categorie->active = $request->input('active');
                $categorie->moneda_id = $request->input('moneda_id');
                $categorie->save();    

                return redirect('/categories')->with('message','update');
            } 


    }



    public function showcategorie(Categorie $categorie)
    {
        
        $items = $categorie->items;
        return view('items.crearitems', compact('categorie'));

    }    



}
