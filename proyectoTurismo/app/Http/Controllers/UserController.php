<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $usuarios = DB::select('select id,name, email from users');
            return DataTables::of($usuarios)
                    ->addColumn('action', function($usuarios){
                        $acciones = '<a href="javascript:void(0)" onclick="editarUsuario('.$usuarios->id.')" class="btn btn-info btn-sm mr-2">Editar</a>';
                        $acciones .= '<button type="button" name="delete" id="'.$usuarios->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        
        return view('admin.usuarios');
    }

    public function registrar(Request $request)
    {
        $password = bcrypt($request->password);
        $usuarios = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [$request->name, $request->email, $password]);
        return back();
    }
    public function eliminar($id){
        $usuarios = DB::table('users')->delete($id);
        return back();
    }
    public function editar($id){
        $usuarios = DB::select('select * from users where id = :id', ['id' => $id]);
        return response()->json($usuarios);
    }

    public function actualizar(Request $request){
        $usuarios = DB::update('update users set name = ?,email = ? where id = ?', [$request->name, $request->email,$request->id]);
        return back();
    }

}
