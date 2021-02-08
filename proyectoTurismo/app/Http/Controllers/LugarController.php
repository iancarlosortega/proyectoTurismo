<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LugarController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $lugares = DB::select('select id,nombre,descripcion,contenido, tipo, categoria from lugares_turisticos');
            return DataTables::of($lugares)
                    ->addColumn('action', function($lugares){
                        $acciones = '<a href="javascript:void(0)" onclick="editarLugar('.$lugares->id.')" class="btn btn-info btn-sm mr-2">Editar</a>';
                        $acciones .= '<button type="button" name="delete" id="'.$lugares->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        
        return view('admin.lugares');
    }

    public function registrar(Request $request)
    {   
        $request->validate([
            'file' => 'image'
        ]);
        $url = Storage::put('turismo', $request->file('file'));
        $user_id = auth()->user()->id;
        $lugares = DB::insert('insert into lugares_turisticos (nombre, descripcion, contenido, imagen, tipo,categoria, user_id) values (?, ?, ?, ?, ?, ?, ?)', 
        [$request->nombre, $request->descripcion, $request->contenido, $url, $request->tipo, $request->categoria, $user_id]);
        return back();
    }
    public function eliminar($id){
        $lugares = DB::table('lugares_turisticos')->delete($id);
        return back();
    }
    public function editar($id){
        $lugares = DB::select('select id, nombre,descripcion,contenido,tipo,categoria from lugares_turisticos where id = :id', ['id' => $id]);
        return response()->json($lugares);
    }

    public function actualizar(Request $request){
        $url = Storage::put('turismo', $request->file('file2'));
        $lugares = DB::update('update lugares_turisticos set nombre = ?,descripcion = ?,contenido = ?,imagen = ?, tipo = ?, categoria = ? where id = ?', [$request->nombre2, $request->descripcion2, $request->contenido2, $url, $request->tipo2, $request->categoria2,$request->idLugar]);
        return back();
    }
}
