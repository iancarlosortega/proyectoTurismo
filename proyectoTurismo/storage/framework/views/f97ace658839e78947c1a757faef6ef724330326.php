
<?php $__env->startSection('title','Visualizaciones'); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="contenido">
        <section><h2>GRÁFICA ESTADÍSTICA</h2></section>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col-4">
                    <form id="generar-grafica" method="post" action="<?php echo e(route('visualizaciones.actualizar')); ?>">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label for="" class="form-label">Establecimiento:</label>
                            <select name="establecimiento" id="establecimiento" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>       
                                <?php for($i = 0; $i < $size3; $i++): ?>                      
                                    <option value="<?php echo e($lugares[$i]); ?>"><?php echo e($lugares[$i]); ?></option>                          
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Tipo de gráfica:</label>
                            <select name="tipo" id="tipo" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                <option value="line">Líneas</option>
                                <option value="column">Columnas</option>
                                <option value="bar">Barras</option>
                                <option value="pie">Circular</option>
                            </select>    
                        </div>
                        <div>      
                            <label>Columnas:</label>
                            <div class="columnas">                
                                <?php for($i = 2; $i < $size; $i++): ?>
                                    <div class="filas">
                                        <input type="checkbox" name="columnas[]" value="<?php echo e($columnas[$i]); ?>" class="ml-2">
                                        <label><?php echo e($columnas[$i]); ?></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label">Año:</label>
                            <select name="anio" id="anio" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                <?php for($i = 0; $i < $size4; $i++): ?>                      
                                    <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Mes:</label>
                            <select name="mes" id="mes" class="form-select" aria-label="Default select example">
                                <option disabled selected>Seleccione una opción</option>
                                <?php for($i = 0; $i < $size2; $i++): ?>                      
                                    <option value="<?php echo e($meses_aux[$i]); ?>"><?php echo e($meses[$i]); ?></option>                          
                                <?php endfor; ?>
                                <option value="all">TODOS LOS MESES</option>
                            </select>
                        </div>
                        <div align='center'>
                            <button type="submit"  id="btn-Generar"  class="btn btn-primary">Crear Grafica</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-8">
                    <br><br>
                    <div id="chart1">
                        <?php echo $chart1; ?>

                    </div>
                </div>
            </div>
        </div>
        <section><h2>COMPARACIÓN ESTADÍSTICA</h2></section>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col">
                    <div class="borde1">
                        <h2>Mensual</h2>
                        <form method="post" action="<?php echo e(route('comparativa.mes.actualizar')); ?>">
                            <?php echo csrf_field(); ?>
                            <H4>Establecimiento :</H4>
                            <section>
                                <select name="establecimiento2" id="establecimiento2" class="form-select" aria-label="Default select example">
                                    <option disabled selected>Seleccione una opción</option>       
                                    <?php for($i = 0; $i < $size3; $i++): ?>                      
                                        <option value="<?php echo e($lugares[$i]); ?>"><?php echo e($lugares[$i]); ?></option>                          
                                    <?php endfor; ?>
                                </select>
                            </section>
                            <h4>Mes 1 :</h4>
                            <section>
                                <div class="row align-items-start">
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Año:</label>
                                            <select name="anio1" id="anio1" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size4; $i++): ?>                      
                                                    <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Mes:</label>
                                            <select name="mes1" id="mes1" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size2; $i++): ?>                      
                                                    <option value="<?php echo e($meses_aux[$i]); ?>"><?php echo e($meses[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <h4>Mes 2 :</h4>
                            <section>
                                <div class="row align-items-start">
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Año:</label>
                                            <select name="anio2" id="anio2" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size4; $i++): ?>                      
                                                    <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="" class="form-label">Mes:</label>
                                            <select name="mes2" id="mes2" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size2; $i++): ?>                      
                                                    <option value="<?php echo e($meses_aux[$i]); ?>"><?php echo e($meses[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>      
                                <h4>Columna :</h4>
                                <select name="columna" id="columna" class="form-select" aria-label="Default select example"> 
                                    <option disabled selected>Seleccione una opción</option>        
                                    <?php for($i = 2; $i < $size; $i++): ?>                      
                                        <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>                          
                                    <?php endfor; ?>
                                </select>
                            </section>
                            <div align='center'>
                                <button type="submit"  id="btn-Generar"  class="btn btn-primary mt-4">Generar Comparativa</button>
                            </div>
                        </form>
                        <div class="estadistica">
                            <span><?php echo e($establecimiento); ?></span><br>
                            <span><?php echo e($columna); ?></span><br>
                            <h2><?php echo e($consulta1); ?></h2>
                            <span><?php echo e($cadena); ?> : <?php echo e($diferencia); ?></span><br>
                            <span><?php echo e($mes1); ?>, <?php echo e($anio1); ?></span>
                            <span>VS</span>
                            <span><?php echo e($mes2); ?>, <?php echo e($anio2); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="borde2"></div>
                        <h2>Anual</h2>
                        <form method="POST" action="<?php echo e(route('comparativa.anio.actualizar')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="anual">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento3" id="establecimiento3" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        <?php for($i = 0; $i < $size3; $i++): ?>                      
                                            <option value="<?php echo e($lugares[$i]); ?>"><?php echo e($lugares[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <h4>Año 1 :</h4>
                                <div>
                                    <select name="anio3" id="anio3" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <?php for($i = 0; $i < $size4; $i++): ?>                      
                                            <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <h4>Año 2 :</h4>
                                <div>
                                    <select name="anio4" id="anio4" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <?php for($i = 0; $i < $size4; $i++): ?>                      
                                            <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div>      
                                    <h4>Columna :</h4>
                                    <select name="columna2" id="columna2" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        <?php for($i = 2; $i < $size; $i++): ?>                      
                                            <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica2">
                            <span><?php echo e($establecimiento2); ?></span><br>
                            <span><?php echo e($columna2); ?></span><br>
                            <h2><?php echo e($consulta3); ?></h2>
                            <span><?php echo e($cadena2); ?> : <?php echo e($diferencia2); ?></span><br>
                            <span><?php echo e($anio3); ?></span>
                            <span>VS</span>
                            <span><?php echo e($anio4); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="error">
            <section><h2>ANÁLISIS ESTADÍSTICO</h2></section>
        </div>
        <div class="visualizaciones-body">
            <div class="row align-items-start">
                <div class="col">
                    <div class="borde3">
                        <h2>Mensual</h2>
                        <form method="POST" action="<?php echo e(route('analisis.mes.actualizar')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="anual2">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento4" id="establecimiento4" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        <?php for($i = 0; $i < $size3; $i++): ?>                      
                                            <option value="<?php echo e($lugares[$i]); ?>"><?php echo e($lugares[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>Mes :</h4>
                                        <div>
                                            <select name="mes3" id="mes3" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size2; $i++): ?>                      
                                                    <option value="<?php echo e($meses_aux[$i]); ?>"><?php echo e($meses[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4>Año :</h4>
                                        <div>
                                            <select name="anio5" id="anio5" class="form-select" aria-label="Default select example">
                                                <option disabled selected>Seleccione una opción</option>
                                                <?php for($i = 0; $i < $size4; $i++): ?>                      
                                                    <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4>Columna :</h4>
                                <div>      
                                    
                                    <select name="columna3" id="columna3" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        <?php for($i = 2; $i < $size; $i++): ?>                      
                                            <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <h4>Función :</h4>
                                <div>
                                    <select name="funcion" id="funcion" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="suma">Suma total</option>
                                        <option value="promedio">Promedio</option>
                                        <option value="max">Valor máximo</option>
                                        <option value="min">Valor mínimo</option>
                                    </select>
                                </div>
                                
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica3">
                            <span><?php echo e($establecimiento3); ?></span><br>
                            <span><?php echo e($funcion); ?> de <?php echo e($columna3); ?></span><br>
                            <h2><?php echo e($consulta5); ?></h2>
                            <span><?php echo e($mes3); ?>,<?php echo e($anio5); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="borde4">
                        <h2>Anual</h2>
                        <form method="POST" action="<?php echo e(route('analisis.anio.actualizar')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="anual">
                                <h4>Establecimiento :</h4>
                                <div>
                                    <select name="establecimiento5" id="establecimiento5" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>       
                                        <?php for($i = 0; $i < $size3; $i++): ?>                      
                                            <option value="<?php echo e($lugares[$i]); ?>"><?php echo e($lugares[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <h4>Año :</h4>
                                <div>
                                    <select name="anio6" id="anio6" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <?php for($i = 0; $i < $size4; $i++): ?>                      
                                            <option value="<?php echo e($anios[$i]); ?>"><?php echo e($anios[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <h4>Columna :</h4>
                                <div>         
                                    <select name="columna4" id="columna4" class="form-select" aria-label="Default select example"> 
                                        <option disabled selected>Seleccione una opción</option>        
                                        <?php for($i = 2; $i < $size; $i++): ?>                      
                                            <option value="<?php echo e($columnas[$i]); ?>"><?php echo e($columnas[$i]); ?></option>                          
                                        <?php endfor; ?>
                                    </select>
                                </div>                            
                                <h4>Función :</h4>
                                <div>
                                    <select name="funcion2" id="funcion" class="form-select" aria-label="Default select example">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="suma">Suma total</option>
                                        <option value="promedio">Promedio</option>
                                        <option value="max">Valor máximo</option>
                                        <option value="min">Valor mínimo</option>
                                    </select>
                                </div>
                                <div align='center'>
                                    <button type="submit"  id="btn-Generar"  class="btn btn-primary">Generar Comparativa</button>
                                </div>
                            </div>
                        </form>
                        <div class="estadistica2">
                            <span><?php echo e($establecimiento4); ?></span><br>
                            <span><?php echo e($funcion2); ?> de <?php echo e($columna4); ?></span><br>
                            <h2><?php echo e($consulta6); ?></h2>
                            <span><?php echo e($anio6); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous"></script>
    
    

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\observatorio\proyectoTurismo\resources\views/visualizaciones.blade.php ENDPATH**/ ?>