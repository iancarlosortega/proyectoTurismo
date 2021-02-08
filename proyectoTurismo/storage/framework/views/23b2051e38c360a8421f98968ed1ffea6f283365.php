
<?php $__env->startSection('title','Restaurantes'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div>
        <div class="container py-8">
            <h1 class="font-bold"><?php echo e($lugar->nombre); ?></h1>

            <div class="grid grid-cols-3 gap-14">

                

                <div class="col-span-2">
                    <div>
                        <img class="w-full h-80 object-cover object-center" src="<?php echo e(Storage::url($lugar->imagen)); ?>" alt="Detalle del lugar">
                    </div>

                    <div class="text-base mt-4">
                        <?php echo $lugar->contenido; ?>

                    </div>
                </div>

                

                <aside>
                    <h1 class="text-center text-2xl font-bold text-gray-600 mb-4">Más lugares turísticos</h1>

                    <ul>
                        <?php $__currentLoopData = $similares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="mb-4">
                                <a class="flex" href="<?php echo e(route('lugaresTuristicos.show',$similar)); ?>">
                                    <img class="w-36 h-20 object-cover object-center" src="<?php echo e(Storage::url($similar->imagen)); ?>" alt="">
                                    <span class="ml-10"><?php echo e($similar->nombre); ?></span>
                                </a>
                            </li>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </aside>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\observatorio\proyectoTurismo\resources\views/turismo/detalle.blade.php ENDPATH**/ ?>