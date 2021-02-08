<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Metrica;
use App\Models\Registros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MetricaController extends Controller
{

    public function index(Request $request)
    {
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);

        if($request->ajax()){
            $metricas = DB::select('select id,titulo, descripcion, formula from metricas');
            return DataTables::of($metricas)
                    ->addColumn('action', function($metricas){
                        $acciones = '<a href="javascript:void(0)" onclick="editarMetrica('.$metricas->id.')" class="btn btn-info btn-sm mr-2">Editar</a>';
                        $acciones .= '<button type="button" name="delete" id="'.$metricas->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        
        return view('admin.metricas', compact('columnas','size'));
    }


    public function registrar(Request $request)
    {
        $aux = "ALTER TABLE registros ADD ". $request->slug . " double";
        DB::statement($aux);
        $cadena = $request->slug. '=' . $request->columna;
        $size = count($request->operadores);
        
        for($i=0; $i<$size; $i++){
            if($request->operadores[$i]=="/"){
                $cadena.= $request->operadores[$i] . "NULLIF(" .$request->columnas[$i].",0)";
            } else{
                $cadena.= $request->operadores[$i] . $request->columnas[$i];
            }
        }
        $aux2 = "update registros set " .$cadena;
        DB::update($aux2);
        $aux3 = "update registros set ". $request->slug." = 0 where ". $request->slug. " is null";
        DB::update($aux3);
        $aux4 = "update registros set ". $request->slug." = round(". $request->slug.",2)";
        DB::update($aux4);
        $metricas = DB::insert('insert into metricas (titulo, slug, descripcion, formula) values (?, ?, ?, ?)', [$request->titulo,$request->slug , $request->descripcion, $cadena]);
        return view('admin.index');
    }

    public function eliminar($id){
        $titulo = Metrica::where('id',$id)->value('slug');
        $metricas = DB::table('metricas')->delete($id);
        $aux = "ALTER TABLE registros DROP ". $titulo;
        DB::statement($aux);
        return back();
    }

    public function editar($id){
        $metricas = DB::select('select * from metricas where id = :id', ['id' => $id]);
        return response()->json($metricas);
    }

    public function actualizar(Request $request){
        $aux = "ALTER TABLE registros CHANGE  ".$request->slug3." ".$request->slug2." double";
        DB::statement($aux);
        $cadena = $request->slug2. '=' . $request->columna;
        $size = count($request->operadores);
        for($i=0; $i<$size; $i++){
            if($request->operadores[$i]=="/"){
                $cadena.= $request->operadores[$i] . "NULLIF(" .$request->columnas[$i].",0)";
            } else{
                $cadena.= $request->operadores[$i] . $request->columnas[$i];
            }
        }
        $aux2 = "update registros set " .$cadena;
        DB::update($aux2);
        $aux3 = "update registros set ". $request->slug2." = 0 where ". $request->slug2. " is null";
        DB::update($aux3);
        $aux4 = "update registros set ". $request->slug2." = round(". $request->slug2.",2)";
        DB::update($aux4);
        $metricas = DB::update('update metricas set titulo = ?,slug = ? , descripcion = ?, formula = ? where id = ?', [$request->titulo2, $request->slug2, $request->descripcion2, $cadena,$request->idMetrica]);
        return back();
    }
}
