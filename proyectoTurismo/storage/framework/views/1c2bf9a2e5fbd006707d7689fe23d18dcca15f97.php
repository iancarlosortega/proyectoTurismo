
<?php $__env->startSection('title','Hoteles'); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>

<div align="center">
    <div class="contenido-turismo">
        <?php $__currentLoopData = $hoteles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <article class="card" style="width: 18rem;">
                <img src="<?php echo e(Storage::url($lugar->imagen)); ?>" class="card-img-top" alt="hotel">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($lugar->nombre); ?></h5>
                    <p class="card-text"><?php echo $lugar->descripcion; ?></p>
                    <a href="<?php echo e(route('lugaresTuristicos.show', $lugar)); ?>" class="btn btn-primary">Ver más</a>
                </div>
            </article>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="turismo-paginacion">
            <?php echo e($hoteles->links()); ?>

        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/turismo/hoteles.blade.php ENDPATH**/ ?>