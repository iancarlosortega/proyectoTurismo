<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LugaresTuristicos;
use Illuminate\Http\Request;

class TurismoController extends Controller
{

    public function parques(){

        $parques = LugaresTuristicos::where('tipo','Parque')->latest()->paginate(6);

        return view('turismo.parques', compact('parques'));

    }

    public function hoteles(){

        $hoteles = LugaresTuristicos::where('tipo','Hotel')->latest()->paginate(6);

        return view('turismo.hoteles', compact('hoteles'));

    }

    public function restaurantes(){

        $restaurantes = LugaresTuristicos::where('tipo','Restaurante')->latest()->paginate(6);

        return view('turismo.restaurantes', compact('restaurantes'));

    }

    public function iglesias(){

        $iglesias = LugaresTuristicos::where('tipo','Iglesia')->latest()->paginate(6);

        return view('turismo.iglesias', compact('iglesias'));

    }

    public function show(LugaresTuristicos $lugar){

        $similares = LugaresTuristicos::where('tipo',$lugar->tipo)
                                ->where('id','!=',$lugar->id)
                                ->latest('id')
                                ->take(6)
                                ->get();

        return view('turismo.detalle', compact('lugar','similares'));
    }

    
}
