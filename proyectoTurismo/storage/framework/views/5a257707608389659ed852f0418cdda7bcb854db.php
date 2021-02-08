<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar de Excel a la Base de Datos</title>
</head>
<body>
    <!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
    Selecciona el archivo a importar:
    <form name="importa" method="post" action="<?php echo e(route('excel')); ?>" enctype="multipart/form-data" >
        <?php echo csrf_field(); ?>
        <input type="file" name="file"/>
        <input type="submit">
    </form> 
</body>
</html>
<?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/welcome.blade.php ENDPATH**/ ?>