

<?php $__env->startSection('title', 'Archivos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gestion de Archivos</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div>
        <form method="POST"  action="<?php echo e(route('datos.cargar')); ?>" class="dropzone" id="my-awesome-dropzone"></form>
    </div>
    <br>
    
    <table id="tabla-archivo" class="table table-hover">
        <thead>
          <td>ID</td>
          <td>Nombre del archivo</td>
          <td>Fecha de subida</td>
          <td>Acciones</td>
        </thead>
      </table>
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
          ¿Desea eliminar el archivo seleccionado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
    
  <script> 
    //Mostrar icono de tipo excel o zip dependiendo del archivo subido 
    Dropzone.options.myAwesomeDropzone = {
      accept: function(file, done) {
      var thumbnail = $(file.previewElement).find('.dz-image:last');
      switch (file.type) {
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
          thumbnail.css('background', 'url(<?php echo e(asset("img/iconos/excelIcon.png")); ?>)');//Asignar la url donde se encuentra el icono
          break;
        case 'application/vnd.ms-excel':
          thumbnail.css('background', 'url(public_path("/img/iconos/excelIcon.png"))');//Asignar la url donde se encuentra el icono
          break;
        }
      done();
      },
      //Validacion de archivos a subir, solo acepta archivos con extension xls,xlsx y zip
      acceptedFiles : ".xls,.xlsx,.zip",
      headers:{
          'X-CSRF-TOKEN' : "<?php echo e(csrf_token()); ?>"
      },
      //Traducir los mensajes de dropzone
      dictDefaultMessage:"Arrastre un archivo excel o .zip para subirlo",
      success: function(response){
        if(response){
        toastr.success('El archivo se ingreso correctamente.', 'Nuevo Archivo', {timeOut:3000});//Mostrar mensaje cuando se cargue el archivo
        $('#tabla-archivo').DataTable().ajax.reload();//Recargar la tabla de archivos para visualizar el dato cargado
        }
      }    
    };
  </script>
  
  <script>
    //--------------------------MOSTRAR ARCHIVOS-----------------------
    $(document).ready(function(){
      var tablaArchivo = $('#tabla-archivo').DataTable({
        processing:true,
        serverSide:true,
        //Traducir datatables a espanol
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
        //Llamar al controlador mediante la ruta 'datos.index'
        ajax:{
          url: "<?php echo e(route('datos.index')); ?>",
        },
        //Seleccionar las columnas que se mostraran en la tabla
        columns:[
          {data: 'id'},
          {data: 'nombre'},
          {data: 'fecha_subida'},
          {data: 'action', orderable:false}
        ]
      });
    });
  </script>
  <script>
    //-------------------------ELIMINAR ARCHIVO----------------------
    var archivo_id;
    //Funcion para cuando el usuario presione el boton eliminar
    $(document).on('click', '.delete', function(){
      archivo_id = $(this).attr('id');//Almacenar el id del archivo
      $('#confirmModal').modal('show');//Mostrar el modal para confirmar la eliminacion
    });
    //Funcion para cuando el usuario confirme la eliminacion del archivo
    $('#btnEliminar').click(function(){
      $.ajax({
        //Enviar la id del archivo al controlador para que lo elimine
        url:"archivos/eliminar/"+archivo_id,
        beforeSend:function(){
          $('#btnEliminar').text('Eliminando...');//Cambiar el texto del boton eliminar por 'Eliminando'
        },
        success:function(data){
          setTimeout(function(){
            $('#confirmModal').modal('hide');//Ocultar el modal cuando culmine con la operacion
            toastr.warning('El archivo fue eliminado correctamente.', 'Eliminar Archivo', {timeOut:3000});//Mostrar mensaje de cuando el archivo se elimine
            $('#tabla-archivo').DataTable().ajax.reload();//Recargar la tabla para que ya no muestre le archivo eliminado
          }, 2000);
          $('#btnEliminar').text('Eliminar');//Volver el boton eliminar al texto original
        }
      });
    });
  </script>
  <script>
    //-----------------------------DESCARGAR ARCHIVO----------------------------------------
    var archivo_id;
    //Funcion para cuando el usuario presione el boton descargar
    $(document).on('click', '.descargar', function(){
      archivo_id = $(this).attr('id');//Almacenar el id del archivo
      $.ajax({
        //Enviar el id al controlador mediante la url
        url:"archivos/descargar/"+archivo_id,
        success:function(data){
          setTimeout(function(){
            toastr.success('El archivo fue descargado correctamente.', 'Descargar Archivo', {timeOut:3000});//Mostrar mensaje para cuando se descargue el archivo
          }, 2000);
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/admin/cargadatos.blade.php ENDPATH**/ ?>