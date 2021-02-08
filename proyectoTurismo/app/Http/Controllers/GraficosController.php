<?php

namespace App\Http\Controllers;
use Validator;
use Image;
use DataTables;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Graficas;
use App\Models\Registros;


class GraficosController extends Controller
{
    public function all(Request $request){
        $grafica = DB::select('select nombre,descripcion,tipo, ruta from graficas');
        $archivo = Archivo::all();
        $lugares = DB::select('select nombre,lugares_turisticos.id from lugares_turisticos, registros where lugares_turisticos.id = registros.id
        ');
        $years = DB::select('select DISTINCT(YEAR(fecha)) as year FROM registros');
        $month = DB::select('select DISTINCT(MONTH(fecha)) as month FROM registros');
        $columnas =  DB::getSchemaBuilder()->getColumnListing('registros');
        $size = count($columnas);
        return view('admin.graficas',compact('archivo','grafica','lugares','years','month','columnas','size'));
        //return url('storage');
    }
    public function index(Request $request){
        if($request->ajax()){
            $grafica = DB::select('select id,nombre,descripcion from graficas');
            return DataTables::of($grafica)
                    ->addColumn('action', function($grafica){
                        $acciones = '<a href="javascript:void(0)" onclick="editarUsuario('.$grafica->id.')" class="btn btn-info btn-sm">Editar</a>';
                        $acciones .= '<button type="button" name="delete" id="'.$grafica->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
    }
    public function store(Request $request){
        
        #$grafica = new Graficas();
        #$grafica->nombre = $request->titulo;
        #$grafica->descripcion = $request->descripcion;
        #$grafica->tipo = $request->tipoGrafica;
        #$grafica->ruta = "null";
        #$grafica->save();
        $titulo = $request->titulo;
        $ruta = "/storage/graficas/$titulo.svg";
        $grafica = DB::insert('insert into graficas (nombre, descripcion, tipo, ruta) values (?, ?, ?, ?)',
         [$request->titulo, $request->descripcion, $request->tipoGrafica, $request->contenido]);

        return response()->json($grafica);

    }
    public function eliminar($id){
        $usuarios = DB::table('graficas')->delete($id);
        return back();
    }
    public function editar($id){
        $usuarios = DB::select('select * from graficas where id = :id', ['id' => $id]);
        return response()->json($usuarios);
    }

    public function actualizar(Request $request){
        $usuarios = DB::update('update graficas set nombre = ?,descripcion = ? where id = ?', [$request->titulo, $request->descripcion,$request->id]);
        return back();
    }

    public function graficar(Request $request){
        $numCol = sizeof($request->columna);
        $mes = $request->mes;
        $year = $request->anio;
        switch ($numCol) {
            case 1:
                $columna1 = $request->columna[0];
                $consulta = DB::select("select DISTINCT fecha, $columna1 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 2:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 3:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 4:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 5:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 6:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $columna6 = $request->columna[5];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4, $columna5 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 7:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $columna6 = $request->columna[5];
                $columna7 = $request->columna[6];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4, $columna5, $columna6, $columna7 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 8:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $columna6 = $request->columna[5];
                $columna7 = $request->columna[6];
                $columna8 = $request->columna[7];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4,
                 $columna5, $columna6, $columna7, $columna8 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 9:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $columna6 = $request->columna[5];
                $columna7 = $request->columna[6];
                $columna8 = $request->columna[7];
                $columna9 = $request->columna[8];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4,
                    $columna5, $columna6, $columna7, $columna8, $columna9 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            case 10:
                $columna1 = $request->columna[0];
                $columna2 = $request->columna[1];
                $columna3 = $request->columna[2];
                $columna4 = $request->columna[3];
                $columna5 = $request->columna[4];
                $columna6 = $request->columna[5];
                $columna7 = $request->columna[6];
                $columna8 = $request->columna[7];
                $columna9 = $request->columna[8];
                $columna10 = $request->columna[9];
                $consulta = DB::select("select DISTINCT fecha, $columna1, $columna2, $columna3, $columna4,
                    $columna5, $columna6, $columna7, $columna8, $columna9, $columna10 FROM registros WHERE MONTH(fecha) = $mes  and YEAR(fecha) = $year");
                break;
            default:
                break;
        }
        
        $consultaJson = json_encode($consulta);
        return $consultaJson;
        #return $request;
    }
}
