
<?php $__env->startSection('title','Visualizaciones'); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <br>
    <h3 align="center">Filtro de búsqueda</h3>
    <br>
    <div class="container">
        <div class="row align-items-start">
            
            <div class="col-4">
                <form id="generar-grafica">
                    <?php echo csrf_field(); ?>
                        <label for="" class="form-label">Establecimiento:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="GRAND VICTORIA BOUTIQUE">Grand Victoria Boutique</option>
                            <option value="SONESTA HOTEL LOJA">Sonesta</option>
                        </select>
                        <br>
                        <label for="" class="form-label">Tipo de gráfica:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="line">Líneas</option>
                            <option value="column">Columnas</option>
                            <option value="bar">Barras</option>
                            <option value="pie">Circular</option>
                            <option value="area">Área</option>
                            <option value="spline">Spline</option>
                            <option value="areaspline">Área spline</option>
                            <option value="scatter">Dispersión</option>
                            <option value="gauge">Indicador</option>
                            <option value="arearange">Rango de área</option>
                            <option value="areasplinerange">Rango de líneas</option>
                            <option value="columnrange">Rango de columnas</option>
                        </select>
                        <br>
                        
                        <label>Columnas:</label>   
                        <select name="columnas[]" id="columnas" class="form-select" aria-label="Default select example">
                            <?php for($i = 4; $i < $size; $i++): ?>
                                <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>
                             <?php endfor; ?>
                        </select> 
                        <br>

                        <label for="" class="form-label">Año:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                        <br>

                        <label for="" class="form-label">Mes:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05" selected>Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                        <br>
                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Crear Grafica</button>
                </form>
            </div>
            
            <div class="col-8">
                <div id="chart1">
                    <?php echo $chart1; ?>

                </div>
            </div>
        </div>
    </div>
    <br>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    
    

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ispa1\OneDrive\Documentos\GitHub\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/visualizaciones.blade.php ENDPATH**/ ?>