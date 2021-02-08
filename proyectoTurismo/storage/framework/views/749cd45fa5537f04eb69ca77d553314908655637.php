

<?php $__env->startSection('title', 'Visualizar registros'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Tabla de datos registrados</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
    
    
    <table id="tabla-registros" class="table table-hover">
        <thead>
            <td>ID</td>
            <td>Establecimiento</td>
            
            <td>Fecha registro</td>
            <td>Checkins</td>
            <td>Chekouts</td>
            <td>Pernoctaciones</td>
            <td>Nacionales</td>
            <td>Extranjeros</td>
            <td>Habitaciones Ocupadas</td>
            <td>Habitaciones Disponibles</td>
            <td>Tipo Tarifa</td>
            <td>Tarifa Promedio</td>
            <td>Tarifa por persona</td>
            <td>Ventas Netas</td>
            <td>Porcentaje Ocupación</td>
            <td>Revpar</td>
            <td>Empleados Temporales</td>
            <td>Estado</td>
            <td>Opciones</td>
        </thead>
    </table>
    
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
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
    
    <script>
        //---------------------MOSTRAR LISTA DE REGISTROS--------------------
        $(document).ready(function(){
            var tablaRegistros = $('#tabla-registros').DataTable({
                processing:true,
                serverSide:true,
                pagingType: 'full_numbers',
                lengthMenu: [[7,15,31,-1],[7,15,31,"Todos"]],
                //Traducir la tabla a espanol
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
                //Llamar al controlador mediante la ruta 'datos.visualizar'
                ajax:{
                    url: "<?php echo e(route('datos.visualizar')); ?>",
                },
                //Seleccionar las columnas que se mostraran en la tabla
                columns:[
                    {data: 'id'},
                    {data: 'establecimiento'},
                    //{data: 'archivo_id'},
                    {data: 'fecha'},
                    {data: 'checkins'},
                    {data: 'checkouts'},
                    {data: 'pernoctaciones'},
                    {data: 'nacionales'},
                    {data: 'extranjeros'},
                    {data: 'habitaciones_ocupadas'},
                    {data: 'habitaciones_disponibles'},
                    {data: 'tipo_tarifa'},
                    {data: 'tarifa_promedio'},
                    {data: 'TAR_PER'},
                    {data: 'ventas_netas'},
                    {data: 'porcentaje_ocupacion'},
                    {data: 'revpar'},
                    {data: 'empleados_temporales'},
                    {data: 'estado'},
                    {data: 'opciones'}
                ],
                "columnDefs": [
                    { "visible": false, "targets": 1 }
                ],
                "order": [[ 1, 'asc' ],[ 0, 'asc' ]],
                scrollX:true,
                "responsive": true,
                drawCallback: function (settings) {
                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).nodes();
                    var last = null;

                    api.column(1, { page: 'current' }).data().each(function (group, i) {

                        if (last !== group) {

                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="18" style="BACKGROUND-COLOR:#17a2b8;font-weight:700;color:#ffff;">' + group  + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
                

            });
            $('a.toggle-vis').on( 'click', function (e) {
                    e.preventDefault();
            
                    // Get the column API object
                    var column = table.column( $(this).attr('data-column') );
            
                    // Toggle the visibility
                    column.visible( ! column.visible() );
                } );
            });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\observatorio\proyectoTurismo\resources\views/admin/visualizardatos.blade.php ENDPATH**/ ?>