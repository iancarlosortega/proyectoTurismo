<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/estilos.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldContent('css'); ?>
    
</head>

<body>
    <header>
        <a class="logo" href="/"><img src="<?php echo e(asset('img/logoObtur.png')); ?>" alt="logo"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="<?php echo e(route('index')); ?>">Inicio</a></li>
                    <li class="dropdown">
                        <button class="dropbtn">Lugares Turisticos</button>
                        <div class="dropdown-content">
                          <a href="<?php echo e(route('lugaresTuristicos.parques')); ?>">Parques</a>
                          <a href="<?php echo e(route('lugaresTuristicos.hoteles')); ?>">Hoteles</a>
                          <a href="<?php echo e(route('lugaresTuristicos.restaurantes')); ?>">Restaurantes</a>
                          <a href="<?php echo e(route('lugaresTuristicos.iglesias')); ?>">Iglesias</a>
                        </div>
                    </li>
                    <li><a href="<?php echo e(route('visualizaciones')); ?>">Visualizaciones</a></li>
                    <li><a href="<?php echo e(route('quienesSomos')); ?>">¿Quiénes somos?</a></li>
                </ul>
            </nav>
            <?php if(Route::has('login')): ?>

                <?php if(auth()->guard()->check()): ?>

                <a href="<?php echo e(url('/admin')); ?>" class="cta">Dashboard</a>

            <?php else: ?>
                <a class="cta" href="<?php echo e(route('login')); ?>">Iniciar Sesión</a>

                <?php endif; ?>
            <?php endif; ?>
            
    </header>
    <?php echo $__env->yieldContent('body'); ?>
    <footer>
        <div class="footer1">
            <div class="UTPL">
    
                <div class="UTPL-titulo">
                    <p>UTPL</p>
                </div><div class="UTPL-region">
                    <p class="region1">Observatorio Turístico</p>
                    <p class="region2">REGIÓN SUR DEL ECUADOR</p>
                </div>
    
            </div><div class="contactos">
    
                <h2>CONTACTOS</h2>
                <br>
                
                <div class="iconoDireccion" >
                    <img src="<?php echo e(asset('img/iconoDireccion.png')); ?>" alt="iconoDireccion">
                    <p>Dirección  :  San Cayetano Alto - Loja</p>
                </div>
                <div>
                    <img src="<?php echo e(asset('img/iconoTelefono.png')); ?>" alt="iconoTelefono">
                    <p>Teléfono  :  0999565400</p>
                </div>
                <div>
                    <img src="<?php echo e(asset('img/iconoCorreo.png')); ?>" alt="iconoCorreo">
                    <p>Correo Electrónico  :  icortega@utpl.edu.ec</p>
                </div>
                
    
            </div><div class="aboutUs">
                <h2>SOBRE NOSOTROS</h2>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit
                amet turpis venenatis nulla dignissim scelerisque. Ut volutpat maximus
                ligula.</p>
                <div class="redes">
                    <img class="inline-block" src="<?php echo e(asset('img/iconoFacebook.png')); ?>" alt="iconoFacebook">
                    <img class="inline-block" src="<?php echo e(asset('img/iconoTwitter.png')); ?>" alt="iconoTwitter">
                    <img class="inline-block" src="<?php echo e(asset('img/iconoYoutube.png')); ?>" alt="iconoYoutube">
                    <img class="inline-block" src="<?php echo e(asset('img/iconoInstagram.png')); ?>" alt="iconoInstagram">
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</html><?php /**PATH C:\Users\ispa1\OneDrive\Documentos\GitHub\observatorio\proyectoTurismo\resources\views/layouts/plantilla.blade.php ENDPATH**/ ?>