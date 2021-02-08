@extends('adminlte::page')

@section('title', 'Lugares turísticos')

@section('content_header')
    <h1>Lugares turísticos</h1>
@stop

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de lugares turísticos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear lugar turístico</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- Mostrar listado de lugares turisticos registrados --}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table id="tabla-lugar" class="table table-hover">
                <thead>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Categoria</td>
                    <td>Descripcion</td>
                    <td class="prueba">Contenido</td>
                    <td>Tipo</td>
                    <td>Acciones</td>
                </thead>
            </table>
        </div>
        {{-- Formulario para registrar un nuevo lugar turistico --}}
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form id="registro-lugar" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="valid-feedback">¡Ok válido!</div>
                    <div class="invalid-feedback">Complete el campo.</div>
                </div>
                <div class="form-group">
                    <label>Tipo:</label>
                    <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                        <option value="Parque">Parque</option>
                        <option value="Hotel">Hotel</option>
                        <option value="Restaurante">Restaurante</option>
                        <option value="Iglesia">Iglesia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Categoría:</label>
                    <select class="form-select" aria-label="Default select example" name="categoria" id="categoria">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Subir imagen:</label>
                            <input type="file" class="form-control" id="file" name="file" accept="image/x-png,image/gif,image/jpeg" required>
                            <div class="valid-feedback">¡Ok válido!</div>
                            <div class="invalid-feedback">Seleccione una imagen.</div>
                        </div>
                        <p>En este apartado únicamente se aceptan archivos de tipo imagen, como por ejemplo: png y jpg.La foto que seleccione será la que se muestre en la página principal según el lugar turísitico</p>
                    </div>
                    <div class="col">
                        <div class="image-wrapper">
                            <img id="picture" src="{{asset('img/seleccionar.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    <div class="valid-feedback">¡Ok válido!</div>
                    <div class="invalid-feedback">Complete el campo.</div>
                </div>
                <div class="form-group">
                    <label>Contenido</label>
                    <textarea name="contenido" id="contenido" class="form-control" required></textarea>
                    <div class="valid-feedback">¡Ok válido!</div>
                    <div class="invalid-feedback">Complete el campo.</div>
                </div>
                
                <button type="submit" class="btn btn-info mt-4">Registrar</button>
            </form>
        </div>
    </div>
    <!--Modal para editar datos-->
    <div class="modal fade" id="lugar_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Lugar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="lugar_edit_form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="idLugar" name="idLugar">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2">
                        </div>
                        <div class="form-group">
                            <label>Tipo:</label>
                            <select class="form-select" aria-label="Default select example" name="tipo2" id="tipo2">
                                <option value="Parque">Parque</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Restaurante">Restaurante</option>
                                <option value="Iglesia">Iglesia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categoría:</label>
                            <select class="form-select" aria-label="Default select example" name="categoria2" id="categoria2">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Subir imagen:</label>
                            <input type="file" class="form-control" id="file2" name="file2" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                               
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea class="form-control" id="descripcion2" name="descripcion2" aria-label="With textarea"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Contenido</label>
                            <textarea class="form-control" id="contenido2" name="contenido2" aria-label="With textarea"></textarea>
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
                    ¿Desea eliminar el registro seleccionado?
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
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;

        }
        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.jqueryui.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
@stop

@section('js')   
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
    {{-- <script>
        
        ClassicEditor
            .create( document.querySelector( '#contenido' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#contenido2' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#descripcion2' ) )
            .catch( error => {
                console.error( error );
            } );
    </script> --}}

    <script>
        //Cambiar imagen
            document.getElementById("file").addEventListener('change', cambiarImagen);

            function cambiarImagen(event){
                var file = event.target.files[0];

                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("picture").setAttribute('src', event.target.result); 
                };

                reader.readAsDataURL(file);
            }
    </script>
    <script>
        //------------------------MOSTRAR LISTADO DE LUGARES TURISTICOS-------------------
        $(document).ready(function(){
            var tablaLugar = $('#tabla-lugar').DataTable({
                fixedColumns: true,
                processing:true,
                serverSide:true,
                responsive:true,
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
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "5%", "targets": 2 },
                    { "width": "30%", "targets": 3 },
                    { "width": "30%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                ],
                //Llamar al controlador mediante la ruta
                ajax:{
                    url: "{{route('lugares.index')}}",
                },
                //Seleccionar las columnas que se mostraran en la tabla
                columns:[
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'categoria'},
                    {data: 'descripcion'},
                    {data: 'contenido'},
                    {data: 'tipo'},
                    {data: 'action', orderable:false}
                ]
            });
        });
        
    </script>
    <script>
        //-----------------------REGISTRAR LUGAR-------------------------------
        $(document).ready(function(){
            //Ejecutar cuando se presione el boton submit del formulario
            $('#registro-lugar').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this)
                //Recuperar y almacenar las variables ingresadas en el formulario
                // var nombre = $('input[name=nombre]').val();
                // var tipo = $('select[name=tipo]').val();
                // var categoria = $('select[name=categoria]').val();
                // var descripcion = $('textarea[name=descripcion]').val();
                // var contenido = $('textarea[name=contenido]').val();
                // var imagen = $('input[name=file]').val();
                // var _token = $("input[name=_token]").val();
                $.ajax({
                    
                    //Enviar la informacion al controlador mediante la ruta 'lugares.registrar'
                    url: "{{route('lugares.registrar')}}",
                    //enctype: 'multipart/form-data',
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response){
                            $('#registro-lugar')[0].reset();//Vaciar el formulario
                            toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se ingrese
                            $('#tabla-lugar').DataTable().ajax.reload();//Recargar la tabla para poder observar el nuevo registro
                        }
                    }
                });
            });
        });
    </script>
    <script>
        //-----------------------ELIMINAR LUGAR-----------------------------
        var lugar_id;
        //Funcion para cuando el usuario presione el boton de eliminar
        $(document).on('click', '.delete', function(){
            lugar_id = $(this).attr('id');//Almacenar el id del lugar turistico
            $('#confirmModal').modal('show');//Mostrar el modal para confirmar la eliminacion del registro
        });
        //Funcion para cuando el usuario confirme la eliminacion del lugar turistico
        $('#btnEliminar').click(function(){
            $.ajax({
                //Enviar el id del lugar turistico al controlador mediante la url
                url:"lugares/eliminar/"+lugar_id,
                beforeSend:function(){
                    $('#btnEliminar').text('Eliminando...');//Cambiar el texto del boton eliminar por Eliminando
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');//Ocultar el modal cuando culmine la eliminacion
                        toastr.warning('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000});//Mostrar mensaje de que el registro se elimino con exito
                        $('#tabla-lugar').DataTable().ajax.reload();//Recargar la tabla para que ya no se muestre el registro eliminado
                    }, 2000);
                    $('#btnEliminar').text('Eliminar');//Volver el texto del boton eliminar a la normalidad
                }
            });
        });
    </script>
    <script>
        //------------------EDITAR LUGAR TURISTICO-----------------------
        function editarLugar(id){
            $.get('lugares/editar/'+id, function(lugare){
                //asignar los datos recuperados a la ventana modal
                $('input[name=idLugar]').val(lugare[0].id);
                $('input[name=nombre2]').val(lugare[0].nombre);
                $('textarea[name=descripcion2]').val(lugare[0].descripcion);
                $('textarea[name=contenido2]').val(lugare[0].contenido);
                $('select[name=tipo2]').val(lugare[0].tipo);
                $('select[name=categoria2]').val(lugare[0].categoria);
                $('input[name=file2]').val(lugare[0].imagen);
                $("input[name=_token]").val();
                $('#lugar_edit_modal').modal('toggle');//Mostrar la ventan modal con los campos llenos
            })
        }
    </script>
    <script>
        //-------------------ACTUALIZAR UN REGISTRO---------------------------
        //Funcion para cuando el usuario presione el boton submit en el formulario de edicion
        $('#lugar_edit_form').submit(function(e){
            e.preventDefault();
            //Almacenar las variables del formulario
            var formData = new FormData(this)
                //Recuperar y almacenar las variables ingresadas en el formulario
                // var nombre = $('input[name=nombre]').val();
                // var tipo = $('select[name=tipo]').val();
                // var categoria = $('select[name=categoria]').val();
                // var descripcion = $('textarea[name=descripcion]').val();
                // var contenido = $('textarea[name=contenido]').val();
                // var imagen = $('input[name=file]').val();
                // var _token = $("input[name=_token]").val();
                $.ajax({
                    
                    //Enviar la informacion al controlador mediante la ruta 'lugares.registrar'
                    url: "{{route('lugares.actualizar')}}",
                    //enctype: 'multipart/form-data',
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response){
                            $('#lugar_edit_modal').modal('hide');//Ocultar el modal cuando culmine la operacion
                            toastr.info('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});//Mostrar mensaje de que se actualizo el registro correctamente
                            $('#tabla-lugar').DataTable().ajax.reload();//Recargar la tabla para observar los cambios
                        }
                    }
                })
        });
    </script>
@stop