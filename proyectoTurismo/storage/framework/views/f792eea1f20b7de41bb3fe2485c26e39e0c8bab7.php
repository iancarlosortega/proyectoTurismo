

<?php $__env->startSection('title', 'Metricas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Metricas</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Métricas</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear Métrica</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table id="tabla-metrica" class="table table-hover">
                <thead>
                <td>ID</td>
                <td>Nombre</td>
                <td>Email</td>
                <td>Acciones</td>
                </thead>
            </table>
        </div>
        
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3>Crear Métrica</h3>
            <form id="registro-metrica" method="post" action="<?php echo e(route('metricas.registrar')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Titulo:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                
                
                <div class="columnas-inputs">
                    <label>Columnas:</label>
                    <button class="add_field_button btn btn-success ml-5">Añadir columna</button>
                    <div class="form-group">
                        <div class="input_fields_wrap">
                            <select name="columna" id="columna" class="form-select mb-2 mt-4" aria-label="Default select example">
                                <?php for($i = 1; $i < $size; $i++): ?>
                                    <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group"> <select name="operadores[]" id="operadores" class="form-select"><option value="+">+</option><option value="-">-</option><option value="*">*</option><option value="/">/</option></select><br><select name="columnas[]" id="columnas" class="form-select mb-2" aria-label="Default select example"><?php for($i = 1; $i < $size; $i++): ?><option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option><?php endfor; ?></select><a href="#" class="remove_field btn btn-danger btn-sm ml-2">Remove</a></div>'); //add input box
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/admin/metricas.blade.php ENDPATH**/ ?>