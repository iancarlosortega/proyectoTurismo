<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugaresTuristicos extends Model
{
    use HasFactory;
    protected $table = "lugares_turisticos";

    protected $fillable = [
        'nombre',
        'descripcion',
        'contenido',
        'imagen',
        'tipo',
        'categoria',
        'user_id'
    ];
    
    public $timestamps = false;

    //Relacion uno a muchos con Usuarios
    public function users(){
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos con Registros
    public function registros(){
        return $this->hasMany(Registros::class);
    }
}
