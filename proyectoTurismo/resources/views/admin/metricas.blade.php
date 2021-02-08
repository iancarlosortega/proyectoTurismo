@extends('adminlte::page')

@section('title', 'Metricas')

@section('content_header')
    <h1>Gestión de métricas</h1>
@stop

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Métricas</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear Métrica</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- Mostrar lista de metricas --}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table id="tabla-metrica" class="table table-hover">
                <thead>
                <td>ID</td>
                <td>Título</td>
                <td>Descripción</td>
                <td>Fórmula</td>
                <td>Acciones</td>
                </thead>
            </table>
        </div>
        {{-- Crear nueva metrica --}}
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3>Crear Métrica</h3>
            <form id="registro-metrica" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label>Titulo:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                    <div class="valid-feedback">¡Ok válido!</div>
                    <div class="invalid-feedback">Complete el campo.</div>
                </div>
                <div class="form-group">
                    <label>Slug:</label>
                    <input type="text" class="form-control" id="slug" name="slug" readonly>
                </div>
                <div class="form-group">
                    <label>Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    <div class="valid-feedback">¡Ok válido!</div>
                    <div class="invalid-feedback">Complete el campo.</div>
                </div>
                {{-- <div class="form-group">
                    <label>Fórmula:</label>
                    <input type="text" class="form-control" id="formula" name="formula">
                </div> --}}
                
                <div class="columnas-inputs">
                    <label>Columnas:</label>
                    <button class="add_field_button btn btn-success ml-5">Añadir columna</button>
                    <div class="form-group">
                        <div class="input_fields_wrap">
                            <select name="columna" id="columna" class="form-select mb-2 mt-4" aria-label="Default select example">
                                @for ($i = 2; $i < $size; $i++)
                                    <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>
                                @endfor
                            </select><br>
                            <select name="operadores[]" id="operadores" class="form-select">
                                <option value="+">+</option>
                                <option value="-">-</option>
                                <option value="*">*</option>
                                <option value="/">/</option>
                            </select><br>
                            <select name="columnas[]" id="columnas" class="form-select mb-2" aria-label="Default select example">
                                @for ($i = 2; $i < $size; $i++)
                                    <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
    <!--Modal para editar datos-->
    <div class="modal fade" id="metrica_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Métrica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="metrica_edit_form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="idMetrica" name="idMetrica">
                        <input type="hidden" id="slug3" name="slug3">
                        
                        <div class="form-group">
                            <label>Titulo :</label>
                            <input type="text" class="form-control" id="titulo2" name="titulo2" required>
                            <div class="valid-feedback">¡Ok válido!</div>
                            <div class="invalid-feedback">Complete el campo.</div>
                        </div>
                        <div class="form-group">
                            <label>Slug:</label>
                            <input type="text" class="form-control" id="slug2" name="slug2" readonly>
                        </div>
                        <div class="form-group">
                            <label>Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion2" name="descripcion2" required>
                            <div class="valid-feedback">¡Ok válido!</div>
                            <div class="invalid-feedback">Complete el campo.</div>
                        </div>                     
                        <div class="columnas-inputs">
                            <label>Columnas:</label>
                            <button class="add_field_button btn btn-success ml-5">Añadir columna</button>
                            <div class="form-group">
                                <div class="input_fields_wrap">
                                    <select name="columna" id="columna" class="form-select mb-2 mt-4" aria-label="Default select example">
                                        @for ($i = 2; $i < $size; $i++)
                                            <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>
                                        @endfor
                                    </select><br>
                                    <select name="operadores[]" id="operadores" class="form-select">
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                        <option value="*">*</option>
                                        <option value="/">/</option>
                                    </select><br>
                                    <select name="columnas[]" id="columnas" class="form-select mb-2" aria-label="Default select example">
                                        @for ($i = 2; $i < $size; $i++)
                                            <option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal eliminar -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar la métrica seleccionada?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.jqueryui.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    
    <script>
        // Validacion para el formulario
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
    </script>
    <script>
        //Anadir columnas para las operaciones
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group"> <select name="operadores[]" id="operadores" class="form-select"><option value="+">+</option><option value="-">-</option><option value="*">*</option><option value="/">/</option></select><br><select name="columnas[]" id="columnas" class="form-select mb-2" aria-label="Default select example">@for ($i = 2; $i < $size; $i++)<option value="{{$columnas[$i]}}">{{$columnas[$i]}}</option>@endfor</select><a href="#" class="remove_field btn btn-danger btn-sm ml-2">Remove</a></div>'); //add input box
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

    <script>
        //Convertir el titulo de la metrica en slug para poder trabajar con la BD
        $(document).ready( function() {
            $("#titulo").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '_'
            });
        });
    </script>
    <script>
        //Convertir el titulo de la metrica en slug para poder trabajar con la BD
        $(document).ready( function() {
            $("#titulo2").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug2',
                space: '_'
            });
        });
    </script>
    <script>
        //------------------------MOSTRAR LISTADO DE LUGARES TURISTICOS-------------------
        $(document).ready(function(){
            var tablaLugar = $('#tabla-metrica').DataTable({
                fixedColumns: true,
                processing:true,
                serverSide:true,
                //Traducir las tablas a espanol
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No existe ningún registro en la tabla",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No existe ningún registro en la tabla",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search":"Buscar:",
                    "paginate":{
                        "next":"Siguiente",
                        "previous":"Anterior"
                    }
                },
                //Llamar al controlador mediante la ruta
                ajax:{
                    url: "{{route('metricas.index')}}",
                },
                //Seleccionar las columnas que se mostraran en la tabla
                columns:[
                    {data: 'id'},
                    {data: 'titulo'},
                    {data: 'descripcion'},
                    {data: 'formula'},
                    {data: 'action', orderable:false}
                ]
            });
        });
        
    </script>
    <script>
        // -------------------REGISTRAR METRICA-------------------------
          $(document).ready(function(){
            
            //Funcion para cuando el formulario sea validado y presionado el boton submit
            $('#registro-metrica').submit(function(e){
                e.preventDefault();
                //Almacenar las variables que han sido ingresadas en el formulario
                var id2 = $('input[name=idMetrica]').val();
                var formData = new FormData(this)
                //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
                $.ajax({
                    url: "{{route('metricas.registrar')}}",
                    type: "POST",
                    //Informacion almacenada enviada al controlador
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response){
                            $('#registro-metrica')[0].reset();
                            toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se cree correctamente
                            $('#tabla-metrica').DataTable().ajax.reload();//Recargar la tabla de usuarios
                        }
                    }
                });
            });
          });
    </script>
    <script>
        //-----------------------ELIMINAR METRICA-----------------------------
        var metrica_id;
        //Funcion para cuando el usuario presione el boton de eliminar
        $(document).on('click', '.delete', function(){
            metrica_id = $(this).attr('id');//Almacenar el id del lugar turistico
            $('#confirmModal').modal('show');//Mostrar el modal para confirmar la eliminacion del registro
        });
        //Funcion para cuando el usuario confirme la eliminacion del lugar turistico
        $('#btnEliminar').click(function(){
            $.ajax({
                //Enviar el id del lugar turistico al controlador mediante la url
                url:"metricas/eliminar/"+metrica_id,
                beforeSend:function(){
                    $('#btnEliminar').text('Eliminando...');//Cambiar el texto del boton eliminar por Eliminando
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');//Ocultar el modal cuando culmine la eliminacion
                        toastr.warning('La métrica fue eliminada correctamente.', 'Eliminar Registro', {timeOut:3000});//Mostrar mensaje de que el registro se elimino con exito
                        $('#tabla-metrica').DataTable().ajax.reload();//Recargar la tabla para que ya no se muestre el registro eliminado
                    }, 2000);
                    $('#btnEliminar').text('Eliminar');//Volver el texto del boton eliminar a la normalidad
                }
            });
        });
    </script>
    <script>
        //------------------EDITAR LUGAR TURISTICO-----------------------
        function editarMetrica(id){
            $.get('metricas/editar/'+id, function(metrica){
                //asignar los datos recuperados a la ventana modal
                $('input[name=idMetrica]').val(metrica[0].id);
                $('input[name=slug3]').val(metrica[0].slug);
                $('input[name=titulo2]').val(metrica[0].titulo);
                $('input[name=slug2]').val(metrica[0].slug);
                $('input[name=descripcion2]').val(metrica[0].descripcion);
                $("input[name=_token]").val();
                $('#metrica_edit_modal').modal('toggle');//Mostrar la ventan modal con los campos llenos
            })
        }
    </script>
    <script>
        //-------------------ACTUALIZAR UN REGISTRO---------------------------
        //Funcion para cuando el usuario presione el boton submit en el formulario de edicion
        $('#metrica_edit_form').submit(function(e){
            e.preventDefault();
                //Almacenar las variables que han sido ingresadas en el formulario
                var formData = new FormData(this)
                //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
                $.ajax({
                    url: "{{route('metricas.actualizar')}}",
                    type: "POST",
                    //Informacion almacenada enviada al controlador
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response){
                            $('#metrica_edit_modal').modal('hide');//Ocultar el modal cuando culmine la operacion
                            toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se cree correctamente
                            $('#tabla-metrica').DataTable().ajax.reload();//Recargar la tabla de usuarios
                        }
                    }
                });
        });
    </script>
@stop