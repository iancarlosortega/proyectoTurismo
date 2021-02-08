<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LugaresTuristicos;
use App\Models\Registros;
use Illuminate\Support\Facades\DB;
use RezaAr\Highcharts\Facade;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /*
        Método que muestra la página principal de visualizaciones, análisis y comparativas estadísticas
        del último mes del último año que se encuentren registrados en la base de datos.

        @return vista, variables necesarias para las visualizaciones, análisis y comparativas estadísticas
    */
    public function index(){
        
        //Opciones que se mostraran en los select de la vista
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);

        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);
        //Informacion necesaria para mostrar la visualización

        $titulo = LugaresTuristicos::select('nombre')->first()->value('nombre');
        //Valores de la base de datos
        $lugar_id = LugaresTuristicos::where('id',1)->value('nombre');
        $data = Registros::where('fecha','LIKE','2019-05%')->where('lugar_id',$lugar_id)->pluck('checkins');

        $chart1 = \Chart::title([
            'text' => $titulo,
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Gráfico estadístico',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series([
            [
                'name'  => 'checkins',
                'data'  => [4,5,3,4,12,4]
                // \'color' => '#0c2959',
            ],
        ])
        ->display();

        //Información necesaria para mostrar los datos de las comparativas por meses
        $establecimiento = LugaresTuristicos::where('id',1)->value('nombre');
        $columna = "Ventas Netas";
        $mes1 = "Mayo";
        $mes2 = "Junio";
        $anio1 = 2019;
        $anio2 = 2019;

        $consulta1 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-05%')
                ->avg('ventas_netas');

        $consulta2 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-06%')
                ->avg('ventas_netas');

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";
          
        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }
        $consulta1 = round($consulta1,2);

        //Información necesaria para mostrar los datos de las comparativas por años
        $establecimiento2 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna2 = "Ventas Netas";
        $anio3 = 2019;
        $anio4 = 2019;

        $consulta3 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta4 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);

        //Información necesaria para mostrar los analisis de los meses

        $establecimiento3 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna3 = "Ventas Netas";
        $mes3 = "Agosto";
        $anio5 = 2019;
        $funcion = "Suma Total";
        $consulta5 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-07%')
                ->sum('ventas_netas');

        $consulta5 = round($consulta5,2);

        //Información necesaria para mostrar los analisis de los anios
        $establecimiento4 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna4 = "Ventas Netas";
        $anio6 = 2019;
        $funcion2 = "Promedio";
        $consulta6 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);
    }

    public function prueba(){

        $prueba = Registros::select('fecha')->distinct(DB::raw("Month(fecha)"))->pluck('fecha');

        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');

        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        
        return $prueba;
    }

    /*
        Método recoge los filtros de las visualizaciones enviados desde la vista para generar las consultas
        a la base de datos
        
        @return vista, variables necesarias para las visualizaciones
    */

    public function graficar(Request $request){

        $titulo = LugaresTuristicos::select('nombre')->where('nombre','LIKE','%'.$request->establecimiento.'%')->value('nombre');
        //Columnas de la tabla registro
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);
        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);
        //Id del establecimiento
        $lugar_id = LugaresTuristicos::where('nombre','LIKE','%'.$request->establecimiento.'%')->select('id')->value('id');
        $n_checkbox = count($request->columnas);
        //Graficar

        

        function random_color_part() {
            return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
        }
        
        function random_color() {
            return random_color_part() . random_color_part() . random_color_part();
        }

        if($request->mes=="all"){

            if($request->tipo == 'pie'){

                $data = array();
                $array_aux = array();
                $array_aux2 = array();

                for($i=0; $i<$n_checkbox; $i++){

            
                    $consulta = Registros::where('fecha','LIKE','%'.$request->anio.'%')->where('lugar_id',$lugar_id)->sum($request->columnas[$i]);
                    $consulta = intval($consulta);
                    $array_aux2= array(
                        "name" => $request->columnas[$i],
                        "y" => $consulta,
                        "color" => "#".random_color());
                    array_push($array_aux, $array_aux2);
                    $array_aux2 = array();
                }
                $data2= array(
                    "name" => "Total",
                    "data" => $array_aux);

                array_push($data, $data2);
                    
                $chart1 = \Chart::title([
                    'text' => $titulo,
                ])
                ->chart([
                    'type'     => 'pie', // pie , columnt ect
                    'renderTo' => 'chart1', // render the chart into your div with id
                ])
                ->subtitle([
                    'text' => "Todos los meses",
                ])
                ->series($data)
                ->display();

            } else {
                $data = array();
                $array_aux = array();

                for($i=0; $i<$n_checkbox; $i++){

                    
                    $consulta = Registros::select(DB::raw("sum(".$request->columnas[$i].") as sum"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('sum');

                    $resultado = array();
                    for($j = 0; $j < count($consulta); $j++){
                        $a = intval($consulta[$j]);
                        array_push($resultado,$a);
                        $a = 0;
                    }

                    $array_aux= array(
                        "name" => $request->columnas[$i],
                        "data" => $resultado,
                        "color" => "#".random_color());
                    array_push($data, $array_aux);
                    $array_aux = array();
                }

                
                    
                $chart1 = \Chart::title([
                    'text' => $titulo,
                ])
                ->chart([
                    'type'     => $request->tipo, // pie , columnt ect
                    'renderTo' => 'chart1', // render the chart into your div with id
                ])
                ->subtitle([
                    'text' => "Todos los meses",
                ])
                ->colors([
                    '#0c2959'
                ])
                ->xaxis([
                    'categories'=> ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'],
                    'labels'     => [
                        'rotation'  => 15,
                        'align'     => 'top',
                        //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                        // use 'startJs:yourjavasscripthere:endJs'
                    ],
                ])
                ->yaxis([
                    'text' => 'This Y Axis',
                ])
                ->legend([
                    'layout'        => 'vertikal',
                    'align'         => 'right',
                    'verticalAlign' => 'middle',
                ])
                ->series($data)
                ->display();
            }

            

        } else{

            $mes = $this->obtenerMes($request->mes);
            

            if($request->tipo == 'pie'){
                
                $data = array();
                $array_aux = array();
                $array_aux2 = array();

                for($i=0; $i<$n_checkbox; $i++){

                    $consulta = Registros::whereYear('fecha',$request->anio)->whereMonth('fecha',$request->mes)->where('lugar_id',$lugar_id)->sum($request->columnas[$i]);
                    $consulta = intval($consulta);
                    $array_aux2= array(
                        "name" => $request->columnas[$i],
                        "y" => $consulta,
                        "color" => "#".random_color());
                    array_push($array_aux, $array_aux2);
                    $array_aux2 = array();
                }
                $data2= array(
                    "name" => "Total",
                    "data" => $array_aux);

                array_push($data, $data2);
                    
                $chart1 = \Chart::title([
                    'text' => $titulo,
                ])
                ->chart([
                    'type'     => 'pie', // pie , columnt ect
                    'renderTo' => 'chart1', // render the chart into your div with id
                ])
                ->subtitle([
                    'text' => $mes,
                ])
                ->series($data)
                ->display();

            }  else {

                $data = array();
                $array_aux = array();

                for($i=0; $i<$n_checkbox; $i++){

                    $consulta = Registros::whereYear('fecha',$request->anio)->whereMonth('fecha',$request->mes)->where('lugar_id',$lugar_id)->pluck($request->columnas[$i]);
                    $array_aux= array(
                        "name" => $request->columnas[$i],
                        "data" => $consulta,
                        "color" => "#".random_color());
                    array_push($data, $array_aux);
                    $array_aux = array();
                }
                    
                    $chart1 = \Chart::title([
                        'text' => $titulo,
                    ])
                    ->chart([
                        'type'     => $request->tipo, // pie , columnt ect
                        'renderTo' => 'chart1', // render the chart into your div with id
                    ])
                    ->subtitle([
                        'text' => $mes,
                    ])
                    ->colors([
                        '#0c2959'
                    ])
                    ->xaxis([
                        'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
                        'labels'     => [
                            'rotation'  => 15,
                            'align'     => 'top',
                            //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                            // use 'startJs:yourjavasscripthere:endJs'
                        ],
                    ])
                    ->yaxis([
                        'text' => 'This Y Axis',
                    ])
                    ->legend([
                        'layout'        => 'vertikal',
                        'align'         => 'right',
                        'verticalAlign' => 'middle',
                    ])
                    ->series($data)
                    ->display();
            }     
        }

        //Comparativa por MESES

        $establecimiento = LugaresTuristicos::where('id',1)->value('nombre');
        $columna = "Ventas Netas";
        $mes1 = "Mayo";
        $mes2 = "Junio";
        $anio1 = 2019;
        $anio2 = 2019;

        $consulta1 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-05%')
                ->avg('ventas_netas');

        $consulta2 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-06%')
                ->avg('ventas_netas');

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";
          
        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }
        
        $consulta1 = round($consulta1,2);

        //Comparativa por ANIOS

        $establecimiento2 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna2 = "Ventas Netas";
        $anio3 = 2019;
        $anio4 = 2019;

        $consulta3 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta4 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);
        
        //Información necesaria para mostrar los analisis de los meses

        $establecimiento3 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna3 = "Ventas Netas";
        $mes3 = "Agosto";
        $anio5 = 2019;
        $funcion = "Suma Total";
        $consulta5 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-07%')
                ->sum('ventas_netas');

        $consulta5 = round($consulta5,2);

        //Información necesaria para mostrar los analisis de los anios
        $establecimiento4 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna4 = "Ventas Netas";
        $anio6 = 2019;
        $funcion2 = "Promedio";
        $consulta6 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);

    }

    /*
        Método recoge los filtros de las comparativas por MESES enviados desde la vista para generar las consultas
        a la base de datos
        
        @return vista, variables necesarias para las visualizaciones
    */

    public function compararMeses(Request $request){

        $titulo = LugaresTuristicos::select('nombre')->first()->value('nombre');
        //Columnas de la tabla registro
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);
        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);
        //Id del establecimiento
        $lugar_id = LugaresTuristicos::where('nombre','LIKE','%'.$request->establecimiento.'%')->select('id')->value('id');

        //Grafica
        $data = Registros::where('fecha','LIKE','2019-05%')->where('lugar_id',$lugar_id)->pluck('checkins');

        $chart1 = \Chart::title([
            'text' => $titulo,
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Gráfico estadístico',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series([
            [
                'name'  => 'checkins',
                'data'  => $data,
                // \'color' => '#0c2959',
            ],
        ])
        ->display();

        //Comparativas por MESES
        $establecimiento = $request->establecimiento2;
        $columna = $request->columna;
        $mes1 = $this->obtenerMes($request->mes1);
        $mes2 = $this->obtenerMes($request->mes2);
        $anio1 = $request->anio1;
        $anio2 = $request->anio2;

        $consulta1 = Registros::where('lugar_id',$lugar_id)
                ->whereYear('fecha',$request->anio1)
                ->whereMonth('fecha',$request->mes1)
                ->avg($request->columna);

        $consulta2 = Registros::where('lugar_id',$lugar_id)
                ->whereYear('fecha',$request->anio2)
                ->whereMonth('fecha',$request->mes2)
                ->avg($request->columna);

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";

        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }

        $consulta1 = round($consulta1,2);

        //Comparativas por ANIOS
        $establecimiento2 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna2 = "Ventas Netas";
        $anio3 = 2019;
        $anio4 = 2019;

        $consulta3 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta4 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);
        
        //Información necesaria para mostrar los analisis de los meses

        $establecimiento3 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna3 = "Ventas Netas";
        $mes3 = "Agosto";
        $anio5 = 2019;
        $funcion = "Suma Total";
        $consulta5 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-07%')
                ->sum('ventas_netas');

        $consulta5 = round($consulta5,2);

        //Información necesaria para mostrar los analisis de los anios
        $establecimiento4 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna4 = "Ventas Netas";
        $anio6 = 2019;
        $funcion2 = "Promedio";
        $consulta6 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);

    }

    /*
        Método recoge los filtros de las comparativas por AÑOS enviados desde la vista para generar las consultas
        a la base de datos
        
        @return vista, variables necesarias para las visualizaciones
    */

    public function compararAnios(Request $request){
        //Opciones que se mostraran en los select de la vista
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);
        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);

        //Informacion necesaria para mostrar la visualización

        $titulo = LugaresTuristicos::select('nombre')->first()->value('nombre');
        //Valores de la base de datos
        $data = Registros::where('fecha','LIKE','2019-05%')->where('lugar_id',1)->pluck('checkins');

        $chart1 = \Chart::title([
            'text' => $titulo,
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Gráfico estadístico',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series([
            [
                'name'  => 'checkins',
                'data'  => $data,
                // \'color' => '#0c2959',
            ],
        ])
        ->display();

        //Información necesaria para mostrar los datos de las comparativas por meses

        $establecimiento = LugaresTuristicos::where('id',1)->value('nombre');
        $columna = "Ventas Netas";
        $mes1 = "Mayo";
        $mes2 = "Junio";
        $anio1 = 2019;
        $anio2 = 2019;

        $consulta1 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-05%')
                ->avg('ventas_netas');

        $consulta2 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-06%')
                ->avg('ventas_netas');

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";
          
        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }
        $consulta1 = round($consulta1,2);

        //Información necesaria para mostrar los datos de las comparativas por años

        $lugar_id2 = LugaresTuristicos::where('nombre','LIKE','%'.$request->establecimiento3.'%')->select('id')->value('id');
        $establecimiento2 = $request->establecimiento3;
        $columna2 = $request->columna2;
        $anio3 = $request->anio3;
        $anio4 = $request->anio4;

        $consulta3 = Registros::where('lugar_id',$lugar_id2)
                ->where('fecha','LIKE','%'.$anio3.'%')
                ->avg($request->columna2);

        $consulta4 = Registros::where('lugar_id',$lugar_id2)
                ->where('fecha','LIKE','%'.$anio4.'%')
                ->avg($request->columna2);

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);
    
        //Información necesaria para mostrar los analisis de los meses

        $establecimiento3 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna3 = "Ventas Netas";
        $mes3 = "Agosto";
        $anio5 = 2019;
        $funcion = "Suma Total";
        $consulta5 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-07%')
                ->sum('ventas_netas');

        $consulta5 = round($consulta5,2);

        //Información necesaria para mostrar los analisis de los anios
        $establecimiento4 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna4 = "Ventas Netas";
        $anio6 = 2019;
        $funcion2 = "Promedio";
        $consulta6 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');
                
        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);
    }

    public function analisisMeses(Request $request){
        //Opciones que se mostraran en los select de la vista
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);
        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);

        //Informacion necesaria para mostrar la visualización

        $titulo = LugaresTuristicos::select('nombre')->first()->value('nombre');
        //Valores de la base de datos
        $data = Registros::where('fecha','LIKE','2019-05%')->where('lugar_id',1)->pluck('checkins');

        $chart1 = \Chart::title([
            'text' => $titulo,
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Gráfico estadístico',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series([
            [
                'name'  => 'checkins',
                'data'  => $data,
                // \'color' => '#0c2959',
            ],
        ])
        ->display();

        //Información necesaria para mostrar los datos de las comparativas por meses
        $establecimiento = LugaresTuristicos::where('id',1)->value('nombre');
        $columna = "Ventas Netas";
        $mes1 = "Mayo";
        $mes2 = "Junio";
        $anio1 = 2019;
        $anio2 = 2019;

        $consulta1 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-05%')
                ->avg('ventas_netas');

        $consulta2 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-06%')
                ->avg('ventas_netas');

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";
          
        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }
        $consulta1 = round($consulta1,2);

        //Información necesaria para mostrar los datos de las comparativas por años
        $establecimiento2 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna2 = "Ventas Netas";
        $anio3 = 2019;
        $anio4 = 2019;

        $consulta3 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta4 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);

        //Información necesaria para mostrar los analisis de los meses
        $lugar_id3 = LugaresTuristicos::where('nombre','LIKE','%'.$request->establecimiento4.'%')->select('id')->value('id');
        $establecimiento3 = $request->establecimiento4;
        $columna3 = $request->columna3;
        $mes3 = $this->obtenerMes($request->mes3);
        $anio5 = $request->anio5;
        $c = $request->funcion;

        if($c=="suma"){
            $consulta5 = Registros::where('lugar_id',$lugar_id3)
                ->whereYear('fecha',$request->anio5)
                ->whereMonth('fecha',$request->mes3)
                ->sum($columna3);
            $funcion = "Suma Total";
        } elseif($c == "promedio"){
            $consulta5 = Registros::where('lugar_id',$lugar_id3)
                ->whereYear('fecha',$request->anio5)
                ->whereMonth('fecha',$request->mes3)
                ->avg($columna3);
            $funcion = "Promedio";
        } elseif($c == "max"){
            $consulta5 = Registros::where('lugar_id',$lugar_id3)
                ->whereYear('fecha',$request->anio5)
                ->whereMonth('fecha',$request->mes3)
                ->max($columna3);
            $funcion = "Valor máximo";
        } elseif($c == "min" ){
            $consulta5 = Registros::where('lugar_id',$lugar_id3)
                ->whereYear('fecha',$request->anio5)
                ->whereMonth('fecha',$request->mes3)
                ->min($columna3);
            $funcion = "Valor mínimo";
        }

        $consulta5 = round($consulta5,2);
        
        //Información necesaria para mostrar los analisis de los anios
        $establecimiento4 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna4 = "Ventas Netas";
        $anio6 = 2019;
        $funcion2 = "Promedio";
        $consulta6 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);
    }

    public function analisisAnios(Request $request){
        //Opciones que se mostraran en los select de la vista
        $resultado =  DB::getSchemaBuilder()->getColumnListing('registros');
        $columnas = array();

        for($i=0; $i<count($resultado); $i++){

            $valor = Registros::select($resultado[$i])->first()->value($resultado[$i]);
            if(!(is_string($valor))){
                array_push($columnas,$resultado[$i]);
            }

        }
        $size = count($columnas);
        $meses_aux = Registros::select(DB::raw("Month(fecha) as month"))
                                ->groupBy(DB::raw("Month(fecha)"))
                                ->pluck('month');
        $size2 = count($meses_aux);

        $meses = array();
        for($i=0; $i<count($meses_aux); $i++){
            $a = $this->obtenerMes($meses_aux[$i]);
            array_push($meses,$a);
        }
        $lugares =  LugaresTuristicos::select('nombre')->pluck('nombre');
        $size3 = count($lugares);
        $anios = Registros::select(DB::raw("Year(fecha) as year"))
                                ->groupBy(DB::raw("Year(fecha)"))
                                ->pluck('year');
        $size4 = count($anios);
        //Informacion necesaria para mostrar la visualización

        $titulo = LugaresTuristicos::select('nombre')->first()->value('nombre');
        //Valores de la base de datos
        $data = Registros::where('fecha','LIKE','2019-05%')->where('lugar_id',1)->pluck('checkins');

        $chart1 = \Chart::title([
            'text' => $titulo,
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Gráfico estadístico',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories'=> ['DIA 1','DIA 2','DIA 3','DIA 4','DIA 5','DIA 6','DIA 7','DIA 8','DIA 9','DIA 10','DIA 11','DIA 12','DIA 13','DIA 14','DIA 15','DIA 16','DIA 17','DIA 18','DIA 19','DIA 20','DIA 21','DIA 22','DIA 23','DIA 24','DIA 25','DIA 26','DIA 27','DIA 28', 'DIA 29', 'DIA 30', 'DIA 31'],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                //'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series([
            [
                'name'  => 'checkins',
                'data'  => $data,
                // \'color' => '#0c2959',
            ],
        ])
        ->display();

        //Información necesaria para mostrar los datos de las comparativas por meses
        $establecimiento = LugaresTuristicos::where('id',1)->value('nombre');
        $columna = "Ventas Netas";
        $mes1 = "Mayo";
        $mes2 = "Junio";
        $anio1 = 2019;
        $anio2 = 2019;

        $consulta1 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-05%')
                ->avg('ventas_netas');

        $consulta2 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-06%')
                ->avg('ventas_netas');

        $diferencia = abs(round(($consulta1 - $consulta2),2));

        $cadena = "";
          
        if($consulta1>$consulta2){
            $cadena = "Crecimiento";
        } else{
            $cadena = "Decrecimiento";
        }
        $consulta1 = round($consulta1,2);

        //Información necesaria para mostrar los datos de las comparativas por años
        $establecimiento2 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna2 = "Ventas Netas";
        $anio3 = 2019;
        $anio4 = 2019;

        $consulta3 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $consulta4 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019%')
                ->avg('ventas_netas');

        $diferencia2 = abs(round(($consulta3 - $consulta4),2));

        $cadena2 = "";
                  
        if($consulta3>$consulta4){
            $cadena2 = "Crecimiento";
        } else{
            $cadena2 = "Decrecimiento";
        }
        $consulta3 = round($consulta3,2);

        //Información necesaria para mostrar los analisis de los meses

        $establecimiento3 = LugaresTuristicos::where('id',1)->value('nombre');
        $columna3 = "Ventas Netas";
        $mes3 = "Agosto";
        $anio5 = 2019;
        $funcion = "Suma Total";
        $consulta5 = Registros::where('lugar_id',1)
                ->where('fecha','LIKE','2019-07%')
                ->sum('ventas_netas');

        $consulta5 = round($consulta5,2);

        //Información necesaria para mostrar los analisis de los anios
        $lugar_id4 = LugaresTuristicos::where('nombre','LIKE','%'.$request->establecimiento5.'%')->select('id')->value('id');
        $establecimiento4 = $request->establecimiento5;
        $columna4 = $request->columna4;
        $anio6 = $request->anio6;
        $c = $request->funcion2;

        if($c=="suma"){
            $consulta6 = Registros::where('lugar_id',$lugar_id4)
                ->where('fecha','LIKE','%'.$anio6.'%')
                ->sum($columna4);
            $funcion2 = "Suma Total";
        } elseif($c == "promedio"){
            $consulta6 = Registros::where('lugar_id',$lugar_id4)
                ->where('fecha','LIKE','%'.$anio6.'%')
                ->avg($columna4);
            $funcion2 = "Promedio";
        } elseif($c == "max"){
            $consulta6 = Registros::where('lugar_id',$lugar_id4)
                ->where('fecha','LIKE','%'.$anio6.'%')
                ->max($columna4);
            $funcion2 = "Valor máximo";
        } elseif($c == "min"){
            $consulta6 = Registros::where('lugar_id',$lugar_id4)
                ->where('fecha','LIKE','%'.$anio6.'%')
                ->min($columna4);
            $funcion2 = "Valor mínimo";
        }

        $consulta6 = round($consulta6,2);
    
        return view('visualizaciones', compact('columnas','size','cadena','mes1','mes2','anio1','anio2','consulta1','diferencia', 'anio3','anio4','consulta3',
        'cadena2','diferencia2','establecimiento','establecimiento2','columna','columna2','establecimiento3','columna3','mes3','anio5','funcion','consulta5',
        'establecimiento4','columna4','anio6','funcion2','consulta6','meses','meses_aux','size2','anios','lugares','size3','size4') 
        , ['chart1' => $chart1,]);
    }

    public function obtenerMes($a){
        $mes = "Grafico estadistico";
        switch ($a) {
            case '01':
                $mes = "ENERO";
                break;
            case '02':
                $mes = "FEBRERO";
                break;
            case '03':
                $mes = "MARZO";
                break;
            case '04':
                $mes = "ABRIL";
                break;
            case '05':
                $mes = "MAYO";
                break;
            case '06':
                $mes = "JUNIO";
                break;
            case '07':
                $mes = "JULIO";
                break;
            case '08':
                $mes = "AGOSTO";
                break;
            case '09':
                $mes = "SEPTIEMBRE";
                break;
            case '10':
                $mes = "OCTUBRE";
                break;
            case '11':
                $mes = "NOVIEMBRE";
                break;
            case '12':
                $mes = "DICIEMBRE";
                break;
            
            default:
                $mes = "Grafico estadistico";
          }
          return $mes;
    }
}
