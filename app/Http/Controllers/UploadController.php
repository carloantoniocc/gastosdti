<?php

namespace GastosDTI\Http\Controllers;

use GastosDTI\Upload;
use GastosDTI\Item;
use GastosDTI\Storage;
use GastosDTI\Factura;
use GastosDTI\Establecimiento;
use Illuminate\Http\Request;
use GastosDTI\ResumenFactura;
use GastosDTI\DetalleFactura;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{

    public function upload(ResumenFactura $resumenfactura)
    {

        //dd($resumenfactura->categorie);

        $factura = Factura::find($resumenfactura->factura_id);
        $item = Item::find($resumenfactura->item_id);   
        $storage = $item->storage;
        $uploads = new Upload;

        return view('uploads.index',compact('factura','item','storage','uploads','resumenfactura'));
        
    }

    public function importar(Request $request,ResumenFactura $resumenfactura)
    {

        switch ($resumenfactura->item->storage->codigo) {
            case 'STG01':
                return $this->stg01($request,$resumenfactura,$resumenfactura->item);
                break;
            case 'STG02':
                return $this->stg02($request,$resumenfactura,$item);
                break;
            case '':
                echo "i es igual a 2";
                break;
        }

    }


    public function stg01(Request $request, ResumenFactura $resumenfactura,Item $item)
    {

        $validator = validator::make($request->all(), [
            'file' => 'max:5000',
            'file' => 'mimes:xls,xlsx'

        ],[

            'file.max' => 'El Peso maximo del archivo es 5 megas',
            'file.mimes' =>'El documento debe ser un archivo de tipo xls, xlsx',

        ]);


        $validator->after(function ($validator) use ($request,$resumenfactura,$item){

            $file = $request->file('file');    
            $excelEsValido = 0;
            
            $excelCheckRows = Excel::selectSheetsByIndex(0)->load($file, function($reader){ $reader->formatDates(true, 'Y-m-d'); })->limit(300, 0)->limitColumns(4, 0)->get();

            $total = 0;
            $titulo1 = 0;
            $titulo2 = 0;

            foreach ($excelCheckRows as $key => $value) {
                

                if (count($value) <> 4) {                
                    $validator->errors()->add('file', 'El numero de columnas no corresponde al especificado en el catalogo');
                    $excelEsValido++;
                    break;
                }elseif ( !isset($value["codigo"]) || !isset($value["cantidad"]) || !isset($value["valorunitario"]) || !isset($value["total"]) ) {
                    $validator->errors()->add('file', 'Nombre de columna no es valido, favor revisar el catalogo');
                    $excelEsValido++;
                    break;
                }


                $establecimiento = Establecimiento::where('entelcode', $value->codigo)->get();
                
                

                if ($value->codigo == null){
                    $validator->errors()->add('file', 'El documento no es valido, valor nulo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                     
                } elseif (count($establecimiento) == 0) {
                    $validator->errors()->add('file', 'El codigo de establecimiento no es valido, favor revisar archivo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif (!is_numeric($value->cantidad)) {
                    $validator->errors()->add('file', 'El documento no es valido, Valor no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif (!is_numeric($value->valorunitario)) {
                    $validator->errors()->add('file', 'El documento no es valido, Valor no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif (!is_numeric($value->total)) {
                    $validator->errors()->add('file', 'El documento no es valido, Valor no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } 

                
                $titulo1 += $value->cantidad;
                $titulo2 += $value->valorunitario;
                $total += $value->total;
            }    


            if ($excelEsValido == 0)
            {

                $resumenfactura->resumen =  $titulo1;
                $resumenfactura->resumen2 =  $titulo2;
                $resumenfactura->monto = $total;
                $resumenfactura->save();


                $mime = \Request::file('file')->getMimeType();
                $extension = strtolower(\Request::file('file')->getClientOriginalExtension());
                $path = "files_uploaded";
                $codigo = uniqid();
                $filenamestorage =  $codigo . '.' . $extension;


                $upload = new Upload();
                $upload->codigo = $codigo;
                $upload->filename = $file->getClientOriginalName();
                $upload->filenamestorage = $filenamestorage;
                $upload->storage_id = $item->storage_id;  
                $upload->iduser = Auth::id();
                

                    if($upload->save())
                    {

                        \Storage::disk('local')->put($filenamestorage,  \File::get($file));

                        foreach ($excelCheckRows as $key => $value) {
                            

                            $detallefactura = new DetalleFactura;
                            $detallefactura->cantidad = $value->cantidad;
                            $detallefactura->valorunitario = $value->valorunitario;
                            $detallefactura->total = $value->total;
                            $detallefactura->comuna_id = NULL;

                            $establecimiento = Establecimiento::where('entelcode','=',$value->codigo)->get()->first();
                            $resumenfactura = ResumenFactura::where('factura_id','=', $resumenfactura->factura_id)->where('item_id','=',$resumenfactura->item_id)->get()->first();

                            $detallefactura->resumen_id = $resumenfactura->id;                           

                            $detallefactura->establecimiento_id = $establecimiento->id;
                            $detallefactura->comuna_id = $establecimiento->comuna_id;
                            $detallefactura->active = 1;
                            $detallefactura->save();

                        }   
                            
                    }else{
                            \File::delete($path."/".$fileName);
                            $validator->errors()->add('file', 'Un error ha ocurrido al momento de registrar el documento');                    
                    }

            }

        });
        


        if ($validator->fails()) {

            return redirect()->back()
            ->withErrors($validator)
            ->withInput();                    
        }else{
            return back()->with('message', 'success');
        }                


    }

    public function stg02(Request $request, ResumenFactura $resumenfactura,Item $item)
    {


        $validator = validator::make($request->all(), [
            'file' => 'max:5000',
            'file' => 'mimes:xls,xlsx'

        ],[

            'file.max' => 'El Peso maximo del archivo es 5 megas',
            'file.mimes' =>'El documento debe ser un archivo de tipo xls, xlsx',

        ]);


        $validator->after(function ($validator) use ($request,$resumenfactura,$item){

            $file = $request->file('file');    
            $excelEsValido = 0;
            
            $excelCheckRows = Excel::selectSheetsByIndex(0)->load($file, function($reader){ $reader->formatDates(true, 'Y-m-d'); })->limit(300, 0)->limitColumns(7, 0)->get();

            $totalitem = 0;

            foreach ($excelCheckRows as $key => $value) {
                

                if (count($value) <> 7) {                
                    $validator->errors()->add('file', 'El numero de columnas no corresponde al especificado en el catalogo');
                    $excelEsValido++;
                    break;
                }elseif ( !isset($value["codigo"]) || !isset($value["servicio"]) || !isset($value["pago_unico"]) || !isset($value["renta_mensual"]) || !isset($value["plazo"]) || !isset($value["inicio_cobro"]) || !isset($value["cuota"]) ) {
                    $validator->errors()->add('file', 'Nombre de columna no es valido, favor revisar el catalogo');
                    $excelEsValido++;
                    break;
                }


                $establecimiento = Establecimiento::where('entelcode', $value->codigo)->get();
                
                

                if ($value->codigo == null){
                    $validator->errors()->add('file', 'El documento no es valido, valor nulo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                     
                } elseif (count($establecimiento) == 0) {
                    $validator->errors()->add('file', 'El codigo de establecimiento no es valido, favor revisar archivo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif ($value->servicio == null) {
                    $validator->errors()->add('file', 'El documento no es valido, Ingrese descripcion del servicio, fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif (!is_numeric($value->pago_unico)) {
                    $validator->errors()->add('file', 'El documento no es valido, pago_unico no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif (!is_numeric($value->renta_mensual)) {
                    $validator->errors()->add('file', 'El documento no es valido, renta_mensual no es numerico en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif ($value->plazo == null) {
                    $validator->errors()->add('file', 'El documento no es valido, Ingrese plazo en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif ($value->inicio_cobro == null) {
                    $validator->errors()->add('file', 'El documento no es valido, Ingrese cobro en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } elseif ($value->cuota == null) {
                    $validator->errors()->add('file', 'El documento no es valido, Ingrese cuota en fila : ' . ($key + 2) . ', favor revisar catalogo.');
                    $excelEsValido++;                    
                } 

                $totalitem += $value->pago_unico + $value->renta_mensual ;

            }    


            if ($excelEsValido == 0)
            {

                $resumenfactura->resumen =  NULL;
                $resumenfactura->monto = $totalitem;
                $resumenfactura->save();



                $mime = \Request::file('file')->getMimeType();
                $extension = strtolower(\Request::file('file')->getClientOriginalExtension());
                $path = "files_uploaded";
                $codigo = uniqid();
                $filenamestorage =  $codigo . '.' . $extension;


                $upload = new Upload();
                $upload->codigo = $codigo;
                $upload->filename = $file->getClientOriginalName();
                $upload->filenamestorage = $filenamestorage;
                $upload->storage_id = $item->storage_id;  
                $upload->iduser = Auth::id();
                

                    if($upload->save())
                    {

                        \Storage::disk('local')->put($filenamestorage,  \File::get($file));

                        foreach ($excelCheckRows as $key => $value) {
                            

                            $detallefactura = new DetalleFactura;
                            $detallefactura->servicio = $value->servicio;
                            $detallefactura->pagounico = $value->pago_unico;
                            $detallefactura->rentamensual = $value->renta_mensual;
                            $detallefactura->total = $value->pago_unico + $value->renta_mensual;
                            $detallefactura->plazo = $value->plazo;
                            $detallefactura->iniciocobro = $value->inicio_cobro;
                            $detallefactura->cuota = $value->cuota;
                            $detallefactura->total = $value->pago_unico + $value->renta_mensual;

                            $establecimiento = Establecimiento::where('entelcode','=',$value->codigo)->get()->first();
                            $resumenfactura = ResumenFactura::where('factura_id','=', $resumenfactura->factura_id)->where('item_id','=',$resumenfactura->item_id)->get()->first();

                            $detallefactura->resumen_id = $resumenfactura->id;                           
                            $detallefactura->establecimiento_id = $establecimiento->id;
                            $detallefactura->save();

                        }   
                            
                    }else{
                            \File::delete($path."/".$fileName);
                            $validator->errors()->add('file', 'Un error ha ocurrido al momento de registrar el documento');                    
                    }

            }

        });
        


        if ($validator->fails()) {

            return redirect()->back()
            ->withErrors($validator)
            ->withInput();                    
        }else{
            return back()->with('message', 'success');
        }  



    }    


    public function downloadFile(Storage $storage){

        $pathtoFile = public_path().'/storage/'. $storage->downloadname;
        return response()->download($pathtoFile);
    } 


}
