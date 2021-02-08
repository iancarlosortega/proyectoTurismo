<?php

namespace App\Imports;

use App\Models\Archivo;
use App\Models\LugaresTuristicos;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Registros;
use Illuminate\Support\Facades\DB;

class ExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $key=>$value)
        {
            if($key>0)
            {   
                //Cambiar el formato de la categoria
                $categoria_aux = explode(' ',$value[2]);
                $categoria = intval($categoria_aux[0]);

                //Hostal a Hotel
                $tipo = $value[1];
                if($tipo == "Hostal"){
                    $tipo = "Hotel";
                }

                //Registrar el lugar turistico en la base de datos
                $user_id = auth()->user()->id;
                LugaresTuristicos::firstOrCreate([
                    'nombre' => $value[0],
                    'tipo' => $tipo,
                    'categoria' => $categoria,
                    'user_id' => $user_id
                ]);

                //Llave foranea con la tabla de lugares turisticos
                $lugar_id = LugaresTuristicos::where('nombre','LIKE','%'.$value[0].'%')->select('id')->value('id');

                //Cambiar el formato de la fecha para importar en la base de datos
                $fechaux = explode('/',$value[5]);
                $fecha = $fechaux[2]."-".$fechaux[1]."-".$fechaux[0];
                
                

                //Ventas netas
                $ventas_netas_aux = $value[11]*$value[14];
                $ventas_netas = round(($value[11]*$value[14]),2);

                //Pernoctaciones
                $tar_per = 0;
                if($value[8] == 0){
                    $tar_per = 0;
                } else{
                    $tar_per = round(($ventas_netas/$value[8]),2);
                }
            
                //Porcentaje Ocupacion y RevPar
                $porcentaje_ocupacion = 0;
                $rev_par = 0;
                if($value[12] == 0){
                    $porcentaje_ocupacion = 0;
                    $rev_par = 0;
                } else{
                    $porcentaje_ocupacion = round((($value[11]/$value[12])*100),2);
                    $rev_par = round(($ventas_netas/$value[12]),2);
                }

                
                $hoteles = Registros::firstOrCreate([
                    'lugar_id' =>$lugar_id,
                    'fecha' => $fecha,
                    'checkins' => $value[6],
                    'checkouts' => $value[7],
                    'pernoctaciones' => $value[8],
                    'nacionales' => $value[9],
                    'extranjeros' => $value[10],
                    'habitaciones_ocupadas' => $value[11],
                    'habitaciones_disponibles' => $value[12],
                    'tipo_tarifa' => $value[13],
                    'tarifa_promedio' => $value[14],
                    'TAR_PER' => $tar_per,
                    'ventas_netas' => $ventas_netas,
                    'porcentaje_ocupacion' => $porcentaje_ocupacion,
                    'revpar' => $rev_par,
                    'empleados_temporales' => $value[19],
                    'estado' => $value[20],
                    'opciones' => $value[21],
                ]);
            }
        }
    }
}

