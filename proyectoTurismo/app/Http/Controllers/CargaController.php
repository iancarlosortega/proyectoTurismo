<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Models\Archivo;
use App\Models\LugaresTuristicos;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $archivos = DB::select('select id,nombre,fecha_subida from archivos');
            return DataTables::of($archivos)
                    ->addColumn('action', function($archivos){
                        $acciones ='<button type="button" name="delete" id="'.$archivos->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        
        return view('admin.cargadatos');
    }

    function cargarArchivos(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,zip,csv'
        ]);
        $fecha_subida = date("Y-m-d");
        $file = $request->file;
        $filename = $file->getClientOriginalName(); //nombre del archivo
        $array = explode(".", $filename);
        $extension = strtolower(end($array)); //extension del archivo
        
        if($extension =='xls'||$extension =='xlsx')
        {
            $ruta_temp = public_path('storage');
            $ruta_temp = $ruta_temp."/".$filename;
            if(file_exists($ruta_temp))//Comprobamos que el archivo existe en el directorio
            {
                $filename = date("Y-m-d-H-i-s").$filename;
                $archivos = Archivo::firstOrCreate([
                    'nombre' => $filename,
                    'url' => $ruta_temp,
                    'fecha_subida' => $fecha_subida
                ]);
                Excel::import(new ExcelImport, $file);
                $file->storeAs('/',$filename);

            } else{
                $archivos = Archivo::firstOrCreate([
                    'nombre' => $filename,
                    'url' => $ruta_temp,
                    'fecha_subida' => $fecha_subida
                ]);
                Excel::import(new ExcelImport, $file);
                $file->storeAs('/',$filename);
            }       
        }elseif($extension == 'zip')
        {
            
            //Extraer el arhivo ZIP en una carpeta temporal
            $zip = new ZipArchive();
            if($zip->open($file,ZipArchive::CREATE)==TRUE)
            {   
                $zip->extractTo(public_path('uncompressed'));
                $zip->close();
            }
            
            //Subir los archivos extraidos
            $files = File::files(public_path('uncompressed'));
            foreach($files as $key=>$value)
            {
                $nombreArchivo = $value->getRelativePathName();
                
                $ruta_temp = public_path('storage');
                $ruta_temp = $ruta_temp."/".$nombreArchivo;
                if(file_exists($ruta_temp))//Comprobamos que el archivo existe en el directorio
                {
                    echo "1";

                } else{
                    
                    copy($value,$ruta_temp);
                    Excel::import(new ExcelImport, $value);
                    $archivos = Archivo::create([
                        'nombre' => $nombreArchivo,
                        'url' => $ruta_temp,
                        'fecha_subida' => $fecha_subida
                    ]);
                }
                unlink($value);//Eliminar los archivos temporales extraidos
                
            }  
            
        } 
    }
    public function eliminar($id){
        $filename = DB::table('archivos')
            ->select('nombre')
            ->where('id','=',$id)
            ->value('nombre');
        $ruta_temp = public_path('storage');
        $ruta_temp = $ruta_temp."/".$filename;
        unlink($ruta_temp);
        $archivos = DB::table('archivos')->delete($id);
        return back();
    }

    public function descargar($id){
        $headers = array(
            'Content-Type'=> 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
          );
        $filename = DB::table('archivos')
            ->select('nombre')
            ->where('id','=',$id)
            ->value('nombre');
        $url = public_path('storage');
        $url = $url."/".$filename; 
        
        return response()->download($url);
        return back();
        
    }

    public function visualizarDatos(Request $request){
        
        //Opciones que se mostraran en los select de la vista
        $columnas =  DB::getSchemaBuilder()->getColumnListing('registros');
        $size = count($columnas);
        if($request->ajax()){
            $registros = DB::select('select * from registros');
            return DataTables::of($registros)
                    ->addColumn('establecimiento', function($registros){
                        $establecimiento = LugaresTuristicos::where('id',$registros->lugar_id)->value('nombre');
                        return $establecimiento;
                    })
                    ->make(true);
            
        }
        
        return view('admin.visualizardatos', ['people'=> $columnas, 'size' => $size]);
    }

    public function truncate(){
        $archivos = DB::table('registros')->truncate();
        return back();
    }

}

