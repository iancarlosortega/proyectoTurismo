
<?php $__env->startSection('title','Lugares Turisticos'); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <img src="<?php echo e(asset('img/slider/puertaDeLaCiudad.png')); ?>" style="width:100%">
  </div>

  <div class="mySlides fade">
    <img src="<?php echo e(asset('img/slider/parqueBolivar.png')); ?>" style="width:100%">
  </div>

  <div class="mySlides fade">
    <img src="<?php echo e(asset('img/slider/iglesiaCatedral.png')); ?>" style="width:100%">
  </div>
  <div class="mySlides fade">
    <img src="<?php echo e(asset('img/slider/iglesiaSantoDomingo.png')); ?>" style="width:100%">
  </div>

  <div class="mySlides fade">
    <img src="<?php echo e(asset('img/slider/parqueJipiro.png')); ?>" style="width:100%">
  </div>
  <div align='center'>
    <div class="contenedor-index">
      <div class="descripcion-proyecto">
        <h2>¿En qué consiste el proyecto del Observatorio de Turismo?</h2>
        <p>El Observatorio Turístico, Región Sur de Ecuador se crea en el año 2016 desde la sección de Hoteleria y Turismo de la UTPL, con el apoyo de los departamentos Administración de Empresas y Economía, de esta misma universidad. Además, como socios externos, y actores fundamentales en el desarrollo de este proyecto se encuentra el Ministerio de Turismo de Ecuador.El objetivo con el que se crea el Observatorio Turístico es facilitar la información necesaria para la toma de decisiones de los diferentes agentes económicos Implicados en el sector turístico, al mismo tiempo que se evalúa el impacto que las políticas públicas e Iniciativas de cualquier otra índole pudiesen tener sobre la mencionada industria turística. </p>
      </div>
      <div class="contenido-azul">
        <div class="contenido-azul-info">
          <h2>Puerta de la Ciudad</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod numquam perspiciatis, voluptatum ipsum accusantium ipsam totam atque iste, nihil ex amet recusandae ullam veritatis sed aperiam eius illum eveniet necessitatibus?</p>
        </div><div class="contenido-azul-img">
          <img src="<?php echo e(asset('img/cards/puertaCiudad.png')); ?>" alt="Puerta de la Ciudad">
        </div>
      </div>
      <div class="contenido-blanco">
        <div class="contenido-blanco-img">
        <img src="<?php echo e(asset('img/cards/jipiro.jpg')); ?>" alt="Jipiro">
        </div><div class="contenido-blanco-info">
          <h2>Jipiro</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod numquam perspiciatis, voluptatum ipsum accusantium ipsam totam atque iste, nihil ex amet recusandae ullam veritatis sed aperiam eius illum eveniet necessitatibus?</p>
        </div>
      </div>
      <div class="contenido-azul">
        <div class="contenido-azul-info">
          <h2>Puerta Simón Bolivar</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod numquam perspiciatis, voluptatum ipsum accusantium ipsam totam atque iste, nihil ex amet recusandae ullam veritatis sed aperiam eius illum eveniet necessitatibus?</p>
        </div><div class="contenido-azul-img">
          <img src="<?php echo e(asset('img/cards/simonBolivar.jpg')); ?>" alt="Parque Simon Bolivar">
        </div>
      </div>
      <div class="contenido-blanco">
        <div class="contenido-blanco-img">
        <img src="<?php echo e(asset('img/cards/sanFrancisco.jpg')); ?>" alt="">
        </div><div class="contenido-blanco-info">
          <h2>Iglesia San Francisco</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod numquam perspiciatis, voluptatum ipsum accusantium ipsam totam atque iste, nihil ex amet recusandae ullam veritatis sed aperiam eius illum eveniet necessitatibus?</p>
        </div>
      </div> 
    </div>
  <div>



  <div class="tarjetas" align="center">
      <div class="card" align="center">
          <div class="imgBx">
              <img src="<?php echo e(asset('img/tarjetaHuespedes.png')); ?>" alt="Huespedes">
          </div>
          <div class="contentBx">
              <h2>Huespedes</h2>
              <div class="grafica">
                  <img src="<?php echo e(asset('img/graficaHuespedes.png')); ?>" alt="">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
              <a href="#">Ver Mas</a>
          </div>
      
      </div><div class="card" align="center">
          <div class="imgBx">
              <img src="<?php echo e(asset('img/tarjetaTarifa.png')); ?>" alt="Tarifa">
          </div>
          <div class="contentBx">
              <h2>Tarifa Promedio</h2>
              <div class="grafica">
                  <img src="<?php echo e(asset('img/graficaHuespedes.png')); ?>" alt="">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
              <a href="#">Ver Mas</a>
          </div>
      </div><div class="card" align="center">
          <div class="imgBx">
              <img src="<?php echo e(asset('img/tarjetaOcupacion.png')); ?>" alt="Ocupacion">
          </div>
          <div class="contentBx">
              <h2>Ocupacion</h2>
              <div class="grafica">
                  <img src="<?php echo e(asset('img/graficaHuespedes.png')); ?>" alt="">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
              <a href="#">Ver Mas</a>
          </div>
      </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
  var slideIndex = 0;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/index.blade.php ENDPATH**/ ?>