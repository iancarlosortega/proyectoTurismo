

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
  <h1>Gestion de Usuarios</h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Usuarios</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear Usuario</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <table id="tabla-usuario" class="table table-hover">
        <thead>
          <td>ID</td>
          <td>Nombre</td>
          <td>Email</td>
          <td>Acciones</td>
        </thead>
      </table>
    </div>
    
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <h3>Crear Usuario</h3>
      <form id="registro-usuario">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="exampleInputName">Nombres y Apellidos</label>
          <input type="text" class="form-control" id="registrarNombre" name="registrarNombre">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Correo electrónico</label>
          <input type="email" class="form-control" id="registrarCorreo" name="registrarCorreo">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Contraseña</label>
          <input type="password" class="form-control" id="registrarContrasenia" name="registrarContrasenia">
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
    </div>
  </div>
  <!--Modal para editar datos-->
  <div class="modal fade" id="usuario_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="usuario_edit_form">
          <div class="modal-body">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="idUsuario" name="idUsuario">
            <div class="form-group">
              <label for="exampleInputName">Nombres y Apellidos</label>
              <input type="text" class="form-control" id="registrarNombre2" name="registrarNombre2">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Correo electrónico</label>
              <input type="email" class="form-control" id="registrarCorreo2" name="registrarCorreo2">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    
    <script>
      // -------------------MOSTRAR LISTA DE USUARIOS-------------------------
      $(document).ready(function(){
        //Crear la tabla de registros
        var tablaUsuario = $('#tabla-usuario').DataTable({
          processing:true,
          serverSide:true,
          //Traducir el plugin de datatables a espanol
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
          //Llamar al controlador mediante la ruta 'usuarios.index'
          ajax:{
            url: "<?php echo e(route('usuarios.index')); ?>",
          },
          //Valores que se mostraran en la tabla
          columns:[
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'action', orderable:false}
          ]
      });
    });
  </script>
    
  <script>
  // -------------------REGISTRAR USUARIO-------------------------
    $(document).ready(function(){
      //Funcion para cuando el formulario sea validado y presionado el boton submit
      $('#registro-usuario').submit(function(e){
        e.preventDefault();
        //Almacenar las variables que han sido ingresadas en el formulario
        var name = $('input[name=registrarNombre]').val();
        var email = $('input[name=registrarCorreo]').val();
        var password = $('input[name=registrarContrasenia]').val();
        var _token = $("input[name=_token]").val();
        //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
        $.ajax({
          url: "<?php echo e(route('usuarios.registrar')); ?>",
          type: "POST",
          //Informacion almacenada enviada al controlador
          data:{
            name: name,
            email: email,
            password: password,
            _token:_token
          },
          success:function(response){
            if(response){
              $('#registro-usuario')[0].reset();
              toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se cree correctamente
              $('#tabla-usuario').DataTable().ajax.reload();//Recargar la tabla de usuarios
            }
          }
        });
      });
    });
  </script>
  <script>
    // -------------------ELIMINAR USUARIO-------------------------

    var usuario_id;
    //Funcion para mostrar el modal de confirmacion cuando sea presionado el boton de eliminar
    $(document).on('click', '.delete', function(){
      usuario_id = $(this).attr('id');//Guardar el id en una variable
        $('#confirmModal').modal('show');//Mostrar el modal para confirmar la eliminacion
    });

    //Funcion para cuando el usuario confirme que quiere eliminar el usuario
    $('#btnEliminar').click(function(){
        $.ajax({
          //Enviar el id del usuario al controlador mediante la ruta
          url:"usuarios/eliminar/"+usuario_id,
          beforeSend:function(){
            $('#btnEliminar').text('Eliminando...');//Cambiar el texto del boton eliminar a 'eliminando'
          },
          success:function(data){
            setTimeout(function(){
              $('#confirmModal').modal('hide');//Cerrar la ventana modal emergente
              toastr.warning('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se elimine correctamente
              $('#tabla-usuario').DataTable().ajax.reload();//Recargar la tabla de usuarios
            }, 2000);
            $('#btnEliminar').text('Eliminar');//Volver el texto del boton eliminar a la normalidad
          }
        });
    });
  </script>
  <script>
    // -------------------EDITAR USUARIO-------------------------
    function editarUsuario(id){
      $.get('usuarios/editar/'+id, function(usuario){
      //asignar los datos recuperados a la ventana modal
      $('input[name=idUsuario]').val(usuario[0].id);
      $('input[name=registrarNombre2]').val(usuario[0].name);
      $('input[name=registrarCorreo2]').val(usuario[0].email);
      $("input[name=_token]").val();
      $('#usuario_edit_modal').modal('toggle');//Mostrar la ventana de modal con el formulario lleno
      })
    }
  </script>
      
  <script>
    // -------------------ACTUALIZAR USUARIO-------------------------
    $('#usuario_edit_form').submit(function(e){
      e.preventDefault();
      //Almacena toda la informacion del formulario en sus respectivas variables
      var id2 = $('input[name=idUsuario]').val();
      var name2 = $('input[name=registrarNombre2]').val();
      var email2 = $('input[name=registrarCorreo2]').val();
      var _token2 = $("input[name=_token]").val();
      $.ajax({
        //Envia la informacion del formulario al controlador mediante la ruta 'usuarios.actualizar'
        url: "<?php echo e(route('usuarios.actualizar')); ?>",
        type: "POST",
        //Informacion almacenada en 'data'
        data:{
          id:id2,
          name:name2,
          email:email2,
          _token:_token2
        },
        success:function(response){
          if(response){
            $('#usuario_edit_modal').modal('hide');//Cerrar la ventana modal emergente
            toastr.info('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se actualice correctamente
            $('#tabla-usuario').DataTable().ajax.reload();//Recargar la tabla de usuarios
          }
        }
      })
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ispa1\OneDrive\Documentos\GitHub\observatorio\proyectoTurismo\resources\views/admin/usuarios.blade.php ENDPATH**/ ?>