<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Uf;
use GastosDTI\Upload;
use GastosDTI\Provider;
use GastosDTI\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class UfController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ufs = Uf::select('id','fecha','valor','active')->orderBy('fecha')->paginate(10);

        return view('ufs.index',compact('ufs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ufs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uf = new Uf;
        $uf->fecha = $request->input('fecha');
        $uf->valor = $request->input('valor');
        $uf->active = $request->input('active');

        $uf->save();

        return redirect('/ufs')->with('message','store');

    }

    /**
     * Display the specified resource.
     *
     * @param  \GastosDTI\Uf  $uf
     * @return \Illuminate\Http\Response
     */
    public function show(Uf $uf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GastosDTI\Uf  $uf
     * @return \Illuminate\Http\Response
     */
    public function edit(Uf $uf)
    {
        return view('ufs.edit',compact('uf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GastosDTI\Uf  $uf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uf $uf)
    {

        $uf->fecha = $request->input('fecha');
        $uf->valor = $request->input('valor');
        $uf->active = $request->input('active');
        $uf->save();

        return redirect('/ufs')->with('message','update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GastosDTI\Uf  $uf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uf $uf)
    {
        //
    }

    public function getcmuf()
    {

        $uploads = DB::table('uploads')
        ->join('users', 'uploads.iduser', '=', 'users.id' )
        ->select('uploads.id as id','uploads.codigo as codigo', 'uploads.created_at as created_at','uploads.filename as filename','uploads.filenamestorage as filenamestorage', 'uploads.codstorage as codstorage', 'users.name as usuario')->paginate(10);
    
     
        return view('ufs.carga_masivauf',compact('uploads'));
    }



    public function getimportar(Request $request)
    {


        $validator = validator::make($request->all(), [
            'file' => 'max:5000',
            'file' => 'mimes:xls,xlsx'

        ],[

            'file.max' => 'El Peso maximo del archivo es 5 megas',
            'file.mimes' =>'El documento debe ser un archivo de tipo xls, xlsx',

        ]);


        $validator->after(function ($validator) use ($request){

            $file = $request->file('file');    
            $excelEsValido = 0;
            
            $excelCheckRows = Excel::selectSheetsByIndex(0)->load($file, function($reader){ $reader->formatDates(true, 'Y-m-d'); })->limit(300, 0)->limitColumns(2, 0)->get();


            foreach ($excelCheckRows as $key => $value) {
                
                $valores = explode('-', $value->fecha);

                if (count($value) <> 2) {                
                    $validator->errors()->add('file', 'El numero de columnas no corresponde al especificado en el catalogo');
                    $excelEsValido++;
                    break;
                }elseif ( !isset($value["fecha"]) || !isset($value["valor"]) ) {
                    $validator->errors()->add('file', 'Nombre de columna no es valido, favor revisar el catalogo');
                    $excelEsValido++;
                    break;
                }elseif ($value->fecha == null) {
                    $validator->errors()->add('file', 'El documento no es valido, Fecha erronea en la fila ' . ($key + 2) . ', favor revisar catalogo');
                    $excelEsValido++;
                }elseif (!checkdate($valores[1], $valores[2], $valores[0])) { 
                    $validator->errors()->add('file', 'El documento no es valido, Ingrese fecha valida en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;
                }

   

                if ($value->valor == null){
                    $validator->errors()->add('file', 'El documento no es valido, valor nulo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                     
                } elseif (!is_numeric($value->valor)) {
                    $validator->errors()->add('file', 'El documento no es valido, Valor no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif ( $value->valor > 9999999) {
                    $validator->errors()->add('file', 'El documento no es valido, valor no valido : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                }


            }    



            if ($excelEsValido == 0)
            {

                $mime = \Request::file('file')->getMimeType();
                $extension = strtolower(\Request::file('file')->getClientOriginalExtension());
                $path = "files_uploaded";
                $codigo = uniqid();
                $filenamestorage =  $codigo . '.' . $extension;


                $upload = new Upload();
                $upload->codigo = $codigo;
                $upload->filename = $file->getClientOriginalName();
                $upload->filenamestorage = $filenamestorage;
                $upload->codstorage = 'UF';
                $upload->iduser = Auth::id();
                

                    if($upload->save())
                    {
                            
                        \Storage::disk('local')->put($filenamestorage,  \File::get($file));

                        foreach ($excelCheckRows as $key => $value) {
                            
                            $uf = new UF;
                            $uf->fecha = $value->fecha;
                            $uf->valor = $value->valor;
                            $uf->save();

                        }   
                            
                    }else{
                            \File::delete($path."/".$fileName);
                            $validator->errors()->add('file', 'Un error ha ocurrido al momento de registrar el documento');                    
                    }

            }

        });
        


        if ($validator->fails()) {

            return redirect('ufs/cmuf')
            ->withErrors($validator)
            ->withInput();                    
        }else{
            return back()->with('message', 'success');
        }                


    }



    public function downloadFile($file){
        $pathtoFile = public_path().'/storage/'.$file;
        return response()->download($pathtoFile);
    }    

    public function downloadfilenamestorage($file){

        $pathtoFile = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . $file;
        return response()->download($pathtoFile);
    }    


}
