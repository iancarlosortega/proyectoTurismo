<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    use HasFactory;
    protected $table = "registros";
    protected $fillable = [
        'lugar_id',
        'archivo_id',
        'fecha',
        'checkins',
        'checkouts',
        'pernoctaciones',
        'nacionales',
        'extranjeros',
        'habitaciones_ocupadas',
        'habitaciones_disponibles',
        'tipo_tarifa',
        'tarifa_promedio',
        'TAR_PER',
        'ventas_netas',
        'porcentaje_ocupacion',
        'revpar',
        'empleados_temporales',
        'estado',
        'opciones'
    ];
    public $timestamps = false;

    //Relacion uno a muchos con Lugares Turisticos
    public function lugares(){
        return $this->belongsTo(LugaresTuristicos::class);
    }

    //Relacion uno a muchos con Lugares Archivos
    public function archivos(){
        return $this->belongsTo(Archivo::class);
    }
}
