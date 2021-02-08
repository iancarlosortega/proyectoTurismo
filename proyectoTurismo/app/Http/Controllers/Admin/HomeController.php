<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function cargaDatos(){
        return view('admin.cargadatos');
    }
    public function visualizarDatos(){
        return view('admin.visualizardatos');
    }
    public function metricas(){
        return view('admin.metricas');
    }
    public function graficas(){
        return view('admin.graficas');
    }
    public function profile(){
        return view('admin.profile');
    }
    public function turismo(){
        return view('admin.turismo');
    }
}
