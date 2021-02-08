@extends('layouts.plantilla')
@section('title','Visualizaciones')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection
@section('body')
    <div class="contenido">
        <section><h2>GRÁFICA ESTADÍSTICA</h2></section>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col-4">
                    <form id="generar-grafica" method="post" action="{{route('visualizaciones.actualizar')}}">
                        @csrf
                        <div>
                            <label for="" class="form-label">Establecimiento:</label>
                            <select name="establecimiento" id="establecimiento" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>       
                                @for ($i = 0; $i < $size3; $i++)                      
                                    <option value="{{$lugares[$i]}}">{{$lugares[$i]}}</option>                          
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Tipo de gráfica:</label>
                            <select name="tipo" id="tipo" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                <option value="line">Líneas</option>
                                <option value="column">Columnas</option>
                                <option value="bar">Barras</option>
                                <option value="pie">Circular</option>
                            </select>    
                        </div>
                        <div>      
                            <label>Columnas:</label>
                            <div class="columnas">                
                                @for ($i = 2; $i < $size; $i++)
                                    <div class="filas">
                                        <input type="checkbox" name="columnas[]" value="{{$columnas[$i]}}" class="ml-2">
                                        <label>{{$columnas[$i]}}</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label">Año:</label>
                            <select name="anio" id="anio" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                @for ($i = 0; $i < $size4; $i++)                      
                                    <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Mes:</label>
                            <select name="mes" id="mes" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                @for ($i = 0; $i < $size2; $i++)                      
                                    <option value="{{$meses_aux[$i]}}">{{$meses[$i]}}</option>                          
                                @endfor
                                <option value="all">TODOS LOS MESES</option>
                            </select>
                        </div>
                        <div align='center'>
                            <button type="submit"  id="btn-Generar"  class="btn btn-primary">Crear Grafica</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-8">
                    <br><br>
                    <div id="chart1">
                        {!! $chart1 !!}
                    </div>
                </div>
            </div>
        </div>
        <section><h2>COMPARACIÓN ESTADÍSTICA</h2></section>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col">
                    <div class="borde1">
                        <h2>Mensual</h2>
                        <form method="post" action="{{route('comparativa.mes.actualizar')}}">
                            @csrf
                            <H4>Establecimiento :</H4>
                            <section>
                                <select name="establecimiento2" id="establecimiento2" class="form-select" aria-label="Default select example">
                                    <option disabled selected>Seleccione una opción</option>       
                                    @for ($i = 0; $i < $size3; $i++)                      
                                        <option value="{{$lugares[$i]}}">{{$lugares[$i]}}</option>                          
                                    @endfor
                                </select>
                            </section>
                            <h4>Mes 1 :</h4>
                            <section>
                                <div class="row align-items-start">
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Año:</label>
                                            <select name="anio1" id="anio1" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size4; $i++)                      
                                                    <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Mes:</label>
                                            <select name="mes1" id="mes1" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size2; $i++)                      
                                                    <option value="{{$meses_aux[$i]}}">{{$meses[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <h4>Mes 2 :</h4>
                            <section>
                                <div class="row align-items-start">
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Año:</label>
                                            <select name="anio2" id="anio2" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size4; $i++)                      
                                                    <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Mes:</label>
                                            <select name="mes2" id="mes2" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size2; $i++)                      
                                                    <option value="{{$meses_aux[$i]}}">{{$meses[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>      
                                <h4>Columna :</h4>
                                <select name="columna" id="columna" class="form-select" aria-label="Default select example"> 
                                    <option disabled selected>Seleccione una opción</option>        
                                    @for ($i = 2; $i < $size; $i++)                      
                                        <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>                          
                                    @endfor
                                </select>
                            </section>
                            <div align='center'>
                                <button type="submit"  id="btn-Generar"  class="btn btn-primary mt-4">Generar Comparativa</button>
                            </div>
                        </form>
                        <div class="estadistica">
                            <span>{{$establecimiento}}</span><br>
                            <span>{{$columna}}</span><br>
                            <h2>{{$consulta1}}</h2>
                            <span>{{$cadena}} : {{$diferencia}}</span><br>
                            <span>{{$mes1}}, {{$anio1}}</span>
                            <span>VS</span>
                            <span>{{$mes2}}, {{$anio2}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="borde2"></div>
                        <h2>Anual</h2>
                        <form method="POST" action="{{route('comparativa.anio.actualizar')}}">
                            @csrf
                            <div class="anual">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento3" id="establecimiento3" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        @for ($i = 0; $i < $size3; $i++)                      
                                            <option value="{{$lugares[$i]}}">{{$lugares[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <h4>Año 1 :</h4>
                                <div>
                                    <select name="anio3" id="anio3" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        @for ($i = 0; $i < $size4; $i++)                      
                                            <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <h4>Año 2 :</h4>
                                <div>
                                    <select name="anio4" id="anio4" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        @for ($i = 0; $i < $size4; $i++)                      
                                            <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <div>      
                                    <h4>Columna :</h4>
                                    <select name="columna2" id="columna2" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        @for ($i = 2; $i < $size; $i++)                      
                                            <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica2">
                            <span>{{$establecimiento2}}</span><br>
                            <span>{{$columna2}}</span><br>
                            <h2>{{$consulta3}}</h2>
                            <span>{{$cadena2}} : {{$diferencia2}}</span><br>
                            <span>{{$anio3}}</span>
                            <span>VS</span>
                            <span>{{$anio4}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="error">
            <section><h2>ANÁLISIS ESTADÍSTICO</h2></section>
        </div>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col">
                    <div class="borde3">
                        <h2>Mensual</h2>
                        <form method="POST" action="{{route('analisis.mes.actualizar')}}">
                            @csrf
                            <div class="anual2">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento4" id="establecimiento4" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        @for ($i = 0; $i < $size3; $i++)                      
                                            <option value="{{$lugares[$i]}}">{{$lugares[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>Mes :</h4>
                                        <div>
                                            <select name="mes3" id="mes3" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size2; $i++)                      
                                                    <option value="{{$meses_aux[$i]}}">{{$meses[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4>Año :</h4>
                                        <div>
                                            <select name="anio5" id="anio5" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                @for ($i = 0; $i < $size4; $i++)                      
                                                    <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4>Columna :</h4>
                                <div>      
                                    
                                    <select name="columna3" id="columna3" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        @for ($i = 2; $i < $size; $i++)                      
                                            <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <h4>Función :</h4>
                                <div>
                                    <select name="funcion" id="funcion" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="suma">Suma total</option>
                                        <option value="promedio">Promedio</option>
                                        <option value="max">Valor máximo</option>
                                        <option value="min">Valor mínimo</option>
                                    </select>
                                </div>
                                
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica3">
                            <span>{{$establecimiento3}}</span><br>
                            <span>{{$funcion}} de {{$columna3}}</span><br>
                            <h2>{{$consulta5}}</h2>
                            <span>{{$mes3}},{{$anio5}}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="borde4">
                        <h2>Anual</h2>
                        <form method="POST" action="{{route('analisis.anio.actualizar')}}">
                            @csrf
                            <div class="anual">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento5" id="establecimiento5" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        @for ($i = 0; $i < $size3; $i++)                      
                                            <option value="{{$lugares[$i]}}">{{$lugares[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <h4>Año :</h4>
                                <div>
                                    <select name="anio6" id="anio6" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        @for ($i = 0; $i < $size4; $i++)                      
                                            <option value="{{$anios[$i]}}">{{$anios[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>
                                <h4>Columna :</h4>
                                <div>         
                                    <select name="columna4" id="columna4" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        @for ($i = 2; $i < $size; $i++)                      
                                            <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>                          
                                        @endfor
                                    </select>
                                </div>                            
                                <h4>Función :</h4>
                                <div>
                                    <select name="funcion2" id="funcion" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="suma">Suma total</option>
                                        <option value="promedio">Promedio</option>
                                        <option value="max">Valor máximo</option>
                                        <option value="min">Valor mínimo</option>
                                    </select>
                                </div>
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica2">
                            <span>{{$establecimiento4}}</span><br>
                            <span>{{$funcion2}} de {{$columna4}}</span><br>
                            <h2>{{$consulta6}}</h2>
                            <span>{{$anio6}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    {{-- <script>
        // -------------------GENERAR GRAFICA-------------------------
        $(document).ready(function(){
            //Funcion para cuando el formulario sea validado y presionado el boton submit
            $('generar-grafica').submit(function(e){
                e.preventDefault();
                //Almacenar las variables que han sido ingresadas en el formulario
                var establecimiento = $('select[name=establecimiento]').val();
                var tipo = $('select[name=tipo]').val();
                var columna = $('select[name=columna]').val();
                var anio = $('select[name=anio]').val();
                var mes = $('select[name=mes]').val();
                var _token = $("input[name=_token]").val();
                //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
                $.ajax({
                    url: "{{route('visualizaciones.actualizar')}}",
                    type: "POST",
                    //Informacion almacenada enviada al controlador
                    data:{
                        establecimiento: establecimiento,
                        tipo: tipo,
                        columna: columna,
                        anio: anio,
                        mes: mes,
                        _token:_token
                    }
                });
                .done(function(data) {
                    //Impleméntalo para que ver que te arroja en la consola, o visualizar si tiene un erro
                    console.log(data); 
                });
            });
        });
    </script> --}}
    {{-- <script>
        jQuery(function ($) {
            $("#establecimiento").change(function(){
                console.log('Hi'); 
                var establecimiento = $('select[name=establecimiento]').val();
                var tipo = $('select[name=tipo]').val();
                var columna = $('select[name=columna]').val();
                var anio = $('select[name=anio]').val();
                var mes = $('select[name=mes]').val();
                $.ajax({
                    //Envia la informacion del formulario al controlador mediante la ruta 'usuarios.actualizar'
                    url: "{{ route('prueba') }}",
                    type: "POST",
                    //Informacion almacenada en 'data'
                    data:{
                    establecimiento:establecimiento,
                    tipo:tipo,
                    columna:columna,
                    anio:anio,
                    mes:mes,
                    _token:_token2
                    },
                });
            });
        });
    </script> --}}

    
@endsection