

<?php $__env->startSection('title', 'Graficas'); ?>

<?php $__env->startSection('content_header'); ?>
        
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <h1>Gestión de gráficas</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Lista de Gráficas</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Crear Gráfica desde archivo</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="grafica-tab" data-toggle="tab" href="#grafica" role="tab" aria-controls="grafica"
            aria-selected="false">Crear Gráfica</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table id="tabla-usuario" class="table table-hover">
            <thead>
                <td>ID</td>
                <td>nombre</td>
                <td>descripcion</td>
                <td>Acciones</td>
            </thead>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h3>Crear Gráfica</h3>
        <form id="registro-grafica">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="exampleInputName">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Nombre del archivo:</label>
                <select id="ddlViewBy" class="form-select" aria-label="Default select example">
                    <?php $__currentLoopData = $archivo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($arc->nombre); ?>"><?php echo e($arc->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Tipo:</label>
                <select id="tipoGrafica" name="tipoGrafica" class="form-select" aria-label="Default select example">
                    <option value="line" selected>Líneas</option>
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
            </div>
            <div class="form-group">
                <label for="exampleInputName">Agrupar por columna:</label>
            </div>
            <div id="tt">
                <input type="checkbox" name="select-all" id="select-all" />
            </div>
            <!--
            <button type="submit" class="btn btn-primary" onclick="return myFunction()">Crear</button>
            <button type="submit" class="btn btn-primary" onclick="return encabesado()">payaa</button>
            <button type="" class="btn btn-primary" onclick="return exportarImg()"></button>
            -->
            <button type="" class="btn btn-primary" onclick="return getHeaders()">Vista Previa</button>
            <button type="submit" class="btn btn-primary" onclick="">guardar grafica</button>

        </form>
        <div id="container" style="height: 400px"></div>

    </div>



    <!-- otro div de graficas-->
    <div class="tab-pane fade" id="grafica" role="tabpanel" aria-labelledby="grafica-tab">
        <h3>Crear Gráfica</h3>
        <form id="generar-grafica" method="post" action="<?php echo e(route('graficas2.graficar')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="exampleInputName">Título</label>
                <input type="text" class="form-control" id="titulo2" name="titulo2">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Descripción</label>
                <input type="text" class="form-control" id="descripcion2" name="descripcion2">
            </div>
            <div>
                <label for="exampleInputName">Nombre Hotel:</label>
                <select name="nombre2" id="nombre2" class="form-select" aria-label="Default select example">
                    <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($arc->id); ?>"><?php echo e($arc->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label for="" class="form-label">Tipo de gráfica:</label>
                <select name="tipo2" id="tipo2" class="form-select" aria-label="Default select example">
                    <option value="line" selected>Líneas</option>
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
            </div>
            <div>
                <label>Columnas:</label>
                <div class="columnas" id="columnas">
                    <?php for($i = 3; $i < $size; $i++): ?> <input type="checkbox" id="columnas" name="columna[]"
                        value="<?php echo e($columnas[$i]); ?>" class="ml-2">
                        <label><?php echo e($columnas[$i]); ?></label>
                        <?php endfor; ?>
                </div>
            </div>
            <div>
                <label for="" class="form-label">Año:</label>
                <select name="anio" id="anio" class="form-select" aria-label="Default select example">
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($arc->year); ?>"><?php echo e($arc->year); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label for="" class="form-label">Mes:</label>
                <select name="mes" id="mes" class="form-select" aria-label="Default select example">
                    <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($arc->month); ?>"><?php echo e($arc->month); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div align='center'>
                <button type="button" id="btn-Generar" class="btn btn-primary">Crear Grafica</button>
                <button type="submit" class="btn btn-primary" onclick="">guardar grafica</button>
            </div>
        </form>

        <div id="container2" style="height: 400px"></div>


    </div>



</div>
<!-- modales y otros html-->
<!--Modal para editar datos-->
<div class="modal fade" id="usuario_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Grafica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="usuario_edit_form">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="idUsuario" name="idUsuario">
                    <div class="form-group">
                        <label for="exampleInputName">Titulo</label>
                        <input type="text" class="form-control" id="titulo3" name="titulo3">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion3" name="descripcion3">
                    </div>
                </div>
                <div id="container3" style="height: 400px">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://rawgit.com/mholt/PapaParse/master/papaparse.js"></script>

<script> console.log('Hi!'); </script>
<script type="text/javascript">
    function myFunction(){
    //obtener nombre archivo
    var e = document.getElementById("ddlViewBy");
    var strUser = e.value;
    //obtener tipo de grafica
    var a = document.getElementById("tipoGrafica");
    var tipo = a.value;
    console.log(strUser);
    //dividir archivo para tener extension
    var arrayStr = strUser.split(".");
    //obtener extencion
    var ext = arrayStr[arrayStr.length-1];
    var csv;
    if(ext != "csv"){
        csv = xlsToCsv(strUser,tipo);
        console.log(csv);
    }else{
        var ruta = "/storage/public/${strUser}";
        graficarCsv(ruta,tipo);
    } 
    return false;
    }
    function graficar(name,tipo){
        $(function () {

        /**
        * Use external CSV parser
        * http://papaparse.com/
        */
        var csv = Papa.parse(name);
        console.log(csv);
        $('#container').highcharts({

            data: {
                rows: csv.data,
                seriesMapping: [{
                    // x: 0, // X values are pulled from column 0 by default
                    // y: 1, // Y values are pulled from column 1 by default
                    label: 2 // Labels are pulled from column 2 and picked up in the dataLabels.format below
                }]
            },
            chart: {
                type: tipo
            },
            title: {
                text: 'Grafica Hotel'
            },
            xAxis: {
                minTickInterval: 24 * 36e5
            },
            yAxis: {
                title: {
                    text: 'Distance'
                },
                labels: {
                    format: '{value} km'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.label}'
                    },
                    tooltip: {
                        valueSuffix: ' km'
                    }
                }
            }

        });
        });

    }
    function xlsToCsv(name,tipo){
        console.log("xls")
        var url = "/storage/public/"+name;
        console.log(url);
        var oReq = new XMLHttpRequest();
        var rowObject;
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";
        
        oReq.onload = function(e) {
        var arraybuffer = oReq.response;
        /* convert data to binary string */
        var data = new Uint8Array(arraybuffer);
        var arr = new Array();
        for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
        var bstr = arr.join("");
        /* Call XLSX */
        var workbook = XLSX.read(bstr, {type:"binary"});
        /* DO SOMETHING WITH workbook HERE */
        var first_sheet_name = workbook.SheetNames[0];
        /* Get worksheet */
        var worksheet = workbook.Sheets[first_sheet_name];
        //console.log(XLSX.utils.sheet_to_csv(worksheet,{raw:true}));
        //escribir archivo
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, worksheet, "People");
        //escribir variable
        wb.SheetNames.forEach(sheet => {
            rowObject = XLSX.utils.sheet_to_csv(wb.Sheets[sheet]);
         });
        //console.log(rowObject);
        graficar(rowObject,tipo);
        //XLSX.writeFile(wb, "sheetjs.csv");
        //subir archivo
        /* build FormData with the generated file */
        var fd = new FormData();
        fd.append('data', new File([data], 'sheetjs.csv'));
        /* send data */
        var req = new XMLHttpRequest();   
        req.open("POST", "/admin/upload", true);
        req.setRequestHeader("X-CSRF-Token", "<?php echo e(csrf_token()); ?>");
        req.send(rowObject);
        }
        oReq.send();
        //console.log(rowObject);
    }
    function graficarCsv(ruta,tipo){
        $(function () {
            $.get(ruta, function(data) {
                $('#container').highcharts({
                        chart: {
                            type: tipo
                        },
                        title: {
                            text: "Fruit Consumtion"
                        },
                        xAxis: {
                            categories: []
                        },
                        yAxis: {
                            title: {
                                text: "Number of students"
                            }
                        },
                        data: {
                            csv: data
                            //csv: document.getElementById('csv').innerHTML
                        },
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        }
                });
            });
            
        });

    }
    </script>
    
    <script>
    function encabesado(){
        var e = document.getElementById("ddlViewBy");
        var strUser = e.value;
        var url = "/storage/"+strUser;
        console.log(url);
        var oReq = new XMLHttpRequest();
        var rowObject;
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";
        
        oReq.onload = function(e) {
        var arraybuffer = oReq.response;
        /* convert data to binary string */
        var data = new Uint8Array(arraybuffer);
        var arr = new Array();
        for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
        var bstr = arr.join("");
        /* Call XLSX */
        var workbook = XLSX.read(bstr, {type:"binary"});
        /* DO SOMETHING WITH workbook HERE */
        var first_sheet_name = workbook.SheetNames[0];
        /* Get worksheet */
        var worksheet = workbook.Sheets[first_sheet_name];
        //console.log(XLSX.utils.sheet_to_csv(worksheet,{raw:true}));
        //escribir archivo
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, worksheet, "People");
        //escribir variable
        var array=[];
        var i=0;
        wb.SheetNames.forEach(sheet => {
            rowObject = XLSX.utils.sheet_to_csv(wb.Sheets[sheet]);
            array[i]=rowObject;
            i= i+1;
         });
        var array2 = array[0].split("\n");
        var array3 = array2[0].split(",");
        option(array3);
        //selection(array3);
        console.log(array3);
        //console.log(rowObject);
        //XLSX.writeFile(wb, "sheetjs.csv");
        //subir archivo
        /* build FormData with the generated file */
        var fd = new FormData();
        fd.append('data', new File([data], 'sheetjs.csv'));
        /* send data */
        var req = new XMLHttpRequest();   
        req.open("POST", "/admin/upload", true);
        req.setRequestHeader("X-CSRF-Token", "<?php echo e(csrf_token()); ?>");
        req.send(rowObject);
        }
        oReq.send();
        return false;
    }
    </script>
    <!-- funciona para options en select
    <script>
        function option(obj){
            console.log(obj);
            select = document.getElementById('selectElementId');
            obj.forEach(data=> {
                var opt = document.createElement('option');
                opt.value = data;
                opt.innerHTML = data;
                select.appendChild(opt);
            });
            return false;
        }
    </script>
    -->
    <!-- detectar clicks y borrar todo en los divs -->
    <script>
        $('#ddlViewBy').click(function() {
            Remove_options();
            encabesado();
        });
        function Remove_options()
        {
        $('#tt')
        .empty();
        }
    </script>
    <!-- escribir los encabazedos -->
    <script>
        function option(obj){
            //obtener div
            select = document.getElementById('tt');
            //recorrer los encabesados
            obj.forEach(data=> {
                //crear elementos
                var newlabel = document.createElement("Label");
                var input = document.createElement("input");
                //dar formato al input
                input.setAttribute("id",data);
                input.setAttribute("type","checkbox");
                input.setAttribute("id",data);
                input.setAttribute("name",data);
                input.setAttribute("value", data);
                //dar formato al label
                newlabel.setAttribute("for",data);
                //escribit los atributos
                newlabel.innerHTML = data;
                select.appendChild(input);
                select.appendChild(newlabel);
            });
            return false;
        }
    </script>
    <script>
        //obtener encabezados  en variable
        function getHeaders(){
            console.log("bb");
            var yourArray=[];
            //var checked = document.querySelectorAll("input[type=checkbox]:checked");
            $("input[type=checkbox]:checked").each(function(){
            yourArray.push($(this).val());
            });
            console.log(yourArray);
            myFunction1(yourArray);
            //checkboxes.value;
            //console.log(checkboxes);
            return false;
        }
    </script>
    <!-- scripts  de prueba
    

    manana
    https://www.highcharts.com/forum/viewtopic.php?t=43520
    https://jsfiddle.net/BlackLabel/myq5uanb/
    
    
    -->
    























<script>
    function exportarImg(){
        sleep(2000);
        var chart = $('#container').highcharts();
        var name = document.getElementById("titulo");
        
        chart.exportChart({
        type: 'png',
        filename: name.value,
        url:'upload',
        formAttributes:("X-CSRF-Token", "<?php echo e(csrf_token()); ?>")
        });
        return false;
    }
    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
        break;
        }
        }
    }
</script>




<script>
    function myFunction1(yourArray){
    //obtener nombre archivo
    var e = document.getElementById("ddlViewBy");
    var strUser = e.value;
    //obtener tipo de grafica
    var a = document.getElementById("tipoGrafica");
    var tipo = a.value;
    console.log(strUser);
    //dividir archivo para tener extension
    var arrayStr = strUser.split(".");
    //obtener extencion
    var ext = arrayStr[arrayStr.length-1];
    var csv;
    if(ext != "csv"){
        csv = xlsToCsv1(strUser,tipo,yourArray);
        console.log(csv);
    }else{
        var ruta = "../storage/${strUser}";
        graficarCsv1(ruta,tipo);
    } 
    return false;
    }
    function graficar1(name,tipo,yourArray){
        $(function () {
            //yourArray.foreach(x=>{console.log(x)});
            
        /**
        * Use external CSV parser
        * http://papaparse.com/
        */

        console.log(yourArray);
        var newCsv = stringToArray(name,yourArray);
        console.log(newCsv);
        setObjeto(newCsv)
        var csv = Papa.parse(newCsv);
        var titulo = $('input[name=titulo]').val();

        //console.log("papaparse")
        console.log(csv);
        $('#container').highcharts({

            data: {
                rows: csv.data,
                seriesMapping: [{
                    // x: 0, // X values are pulled from column 0 by default
                    // y: 1, // Y values are pulled from column 1 by default
                    label: 2 // Labels are pulled from column 2 and picked up in the dataLabels.format below
                }],
                complete: function(options) {
                }
            },
            credits: {
                enabled: false
            },
            chart: {
                type: tipo
            },
            title: {
                text: titulo
            },
            xAxis: {
                minTickInterval: 24 * 36e5
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    format: '{value} '
                }
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                layout: 'vertical',
                x: 0,
                y: 100
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.label}'
                    },
                    tooltip: {
                        valueSuffix: ''
                    }
                }
            }

        });
        });

    }
    function xlsToCsv1(name,tipo,yourArray){
        console.log("xls")
        var url = "../storage/"+name;
        console.log(url);
        var oReq = new XMLHttpRequest();
        var rowObject;
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";
        
        oReq.onload = function(e) {
        var arraybuffer = oReq.response;
        /* convert data to binary string */
        var data = new Uint8Array(arraybuffer);
        var arr = new Array();
        for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
        var bstr = arr.join("");
        /* Call XLSX */
        var workbook = XLSX.read(bstr, {type:"binary"});
        /* DO SOMETHING WITH workbook HERE */
        var first_sheet_name = workbook.SheetNames[0];
        /* Get worksheet */
        var worksheet = workbook.Sheets[first_sheet_name];
        //console.log(XLSX.utils.sheet_to_csv(worksheet,{raw:true}));
        //escribir archivo
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, worksheet, "People");
        //escribir variable
        wb.SheetNames.forEach(sheet => {
            rowObject = XLSX.utils.sheet_to_csv(wb.Sheets[sheet]);
         });
        //console.log(rowObject);
        graficar1(rowObject,tipo,yourArray);
        //XLSX.writeFile(wb, "sheetjs.csv");
        //subir archivo
        /* build FormData with the generated file */
        var fd = new FormData();
        fd.append('data', new File([data], 'sheetjs.csv'));
        /* send data */
        var req = new XMLHttpRequest();   
        req.open("POST", "/admin/upload", true);
        req.setRequestHeader("X-CSRF-Token", "<?php echo e(csrf_token()); ?>");
        req.send(rowObject);
        }
        oReq.send();
        //console.log(rowObject);
    }

</script>
<script>
    function stringToArray(text,data){
        //dividir por salto de linea
        var newText = text.split("\n");
        var arrayTxt=[];
        //crear muestra para obtener longitud
        var muestra= newText[0].split(",")
        var i=0;
        var j=0;
        //bucle para poblar datos
        while (i<newText.length) {
            //se debe crear otro parametro cada ves
            arrayTxt.push([]);
            var auxText = newText[i].split(",");
            console.log(auxText);
            while(j<muestra.length){
                arrayTxt[i][j]= auxText[j];
                console.log(arrayTxt[i][j]);
                j= j+1;
            }
            i= i+1;
            j=0;
        }
        //bucle para la muestra
        i=0;
        var str = "";
        i = 0;
        j=0;
        var arr = [];
        //comparar la muestra para eliminar columnas
        muestra.forEach(element => {
            if (data.includes(element) == false){
                arr.push([])
                arr[j]=i;
                j= j+1;
            }
            i = i+1;
        });
        i=0;
        console.log("indeces");
        console.log(arr);

        //-------------------------------------------------------------------------------
        //eliminar las columnas
        arr.forEach(element => {
            element = element - i;
            arrayTxt.forEach(a => a.splice(element, 1));
            i+=1;
        });
        console.log("array eliminado columnas");
        console.log(arrayTxt);

        //obtener muestra
    
        //bucle para crear texto
        var str = "";
        i = 0;
        j=0;
        str="";
        while (i<arrayTxt.length-1) {
            //se debe crear otro parametro cada ves
            while(j<data.length){
                if (j==data.length) {
                    str = str+arrayTxt[i][j];
                }else{
                    str = str+arrayTxt[i][j]+",";
                }
                j= j+1; 
                console.log(str);
            }
            str=str +"\n";
            i= i+1;
            j=0;
        }
        
        return str;
        
        }

</script>

<script>
  // -------------------REGISTRAR USUARIO desde xlms-------------------------
    $(document).ready(function(){
      //Funcion para cuando el formulario sea validado y presionado el boton submit
      $('#registro-grafica').submit(function(e){
        e.preventDefault();
        //Almacenar las variables que han sido ingresadas en el formulario
        var contenido = getObjeto();
        var titulo = $('input[name=titulo]').val();
        var descripcion = $('input[name=descripcion]').val();
        var tipoGrafica = $('select[name=tipoGrafica]').val();
        var _token = $("input[name=_token]").val();
        console.log(titulo,descripcion,tipoGrafica,_token);
        //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
        $.ajax({
          url: "<?php echo e(route('store')); ?>",
          type: "POST",
          //Informacion almacenada enviada al controlador
          data:{
            contenido: contenido,
            titulo: titulo,
            descripcion: descripcion,
            tipoGrafica: tipoGrafica,
            _token:_token
          },
          success:function(response){
            if(response){
              $('#registro-grafica')[0].reset();
              toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se cree correctamente
              $('#tabla-usuario').DataTable().ajax.reload();//Recargar la tabla de usuarios
            }
          }
        });
        //exportarImg();
      });
    });
  </script>
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
            url: "<?php echo e(route('graficas2.index')); ?>",
          },
          //Valores que se mostraran en la tabla
          columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'descripcion'},
            //{data: 'ruta'},
            {data: 'action', orderable:false}
          ]
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
          url:"graficas/eliminar/"+usuario_id,
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
    var ide;
    // -------------------EDITAR USUARIO-------------------------
    function editarUsuario(id){
      $.get('graficas/editar/'+id, function(usuario){
      //asignar los datos recuperados a la ventana modal
      $('input[name=titulo3]').val(usuario[0].nombre);
      $('input[name=descripcion3]').val(usuario[0].descripcion);
      $("input[name=_token]").val();
      $('#usuario_edit_modal').modal('toggle');//Mostrar la ventana de modal con el formulario lleno
      graficar3(usuario[0].ruta,usuario[0].tipo,usuario[0].nombre);
      ide = id;
      console.log(ide);
      })
      
    }
    
    // -------------------ACTUALIZAR USUARIO-------------------------
    $('#usuario_edit_form').submit(function(e){
      e.preventDefault();
      console.log("entro");
      //Almacena toda la informacion del formulario en sus respectivas variables
      console.log(ide);

      var id2 = ide;
      var titulo = $('input[name=titulo3]').val();
      var descripcion = $('input[name=descripcion3]').val();
      var _token2 = $("input[name=_token]").val();
      console.log(id2);
      console.log(id2,titulo,descripcion);
      $.ajax({
        //Envia la informacion del formulario al controlador mediante la ruta 'usuarios.actualizar'
        url: "<?php echo e(route('graficas2.actualizar')); ?>",
        type: "POST",
        //Informacion almacenada en 'data'
        data:{
          id:id2,
          titulo:titulo,
          descripcion:descripcion,
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
  <script>
        // -------------------GENERAR GRAFICA-------------------------
        $(document).ready(function(){
            //Funcion para cuando el formulario sea validado y presionado el boton submit
            $(document).on("click","#btn-Generar",function(e){
                e.preventDefault();
                //Almacenar las variables que han sido ingresadas en el formulario
                var establecimiento = $('select[name=nombre2]').val();
                var tipo = $('select[name=tipo2]').val();
                var columna = columnas();
                console.log(columna);
                var anio = $('select[name=anio]').val();
                var mes = $('select[name=mes]').val();
                var _token = $("input[name=_token]").val();
                //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
                $.ajax({
                    url: "<?php echo e(route('graficas2.graficar')); ?>",
                    type: "POST",
                    //Informacion almacenada enviada al controlador
                    data:{
                        establecimiento: establecimiento,
                        tipo: tipo,
                        columna: columna,
                        anio: anio,
                        mes: mes,
                        _token:_token
                    },
                    success: function(data){
                        console.log(data);
                    }
                }).done(function (data) {
                console.log(data);
                setObjeto(data);
                graficarBase(data);
            })
            .fail(function () {
                console.log('Failed');
            });
            });
        });
        
        //obtener encabezados  en variable
        function columnas(){
            var selected = [];
            $('#columnas input:checked').each(function() {
                selected.push($(this).attr('value'));
            });
            return selected;
        }
    </script> 
    <script>
        function graficarBase(yourArray){
        $(function () {
            //yourArray.foreach(x=>{console.log(x)});
            
        /**
        * Use external CSV parser
        * http://papaparse.com/
        */

        var newCsv = Papa.unparse(yourArray);
        var csv = Papa.parse(newCsv);
        var tipo = $('select[name=tipo2]').val();
        var titulo = $('input[name=titulo2]').val();

        //console.log("papaparse")
        //console.log(csv);
        $('#container2').highcharts({

            data: {
                rows: csv.data,
                seriesMapping: [{
                    // x: 0, // X values are pulled from column 0 by default
                    // y: 1, // Y values are pulled from column 1 by default
                    //label: 2 // Labels are pulled from column 2 and picked up in the dataLabels.format below
                }]
            },
            credits: {
                enabled: false
            },
            chart: {
                type: tipo
            },
            title: {
                text: titulo
            },
            xAxis: {
                minTickInterval: 24 * 36e5
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    format: '{value} '
                }
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                layout: 'vertical',
                x: 0,
                y: 100
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.label}'
                    },
                    tooltip: {
                        valueSuffix: ' '
                    }
                }
            }

        });
        });

    }
    </script>
    <script>
  // -------------------REGISTRAR Grafica-------------------------
    $(document).ready(function(){
      //Funcion para cuando el formulario sea validado y presionado el boton submit
      $('#generar-grafica').submit(function(e){
        e.preventDefault();
        //Almacenar las variables que han sido ingresadas en el formulario
        var contenido = getObjeto();
        var titulo = $('input[name=titulo2]').val();
        var descripcion = $('input[name=descripcion2]').val();
        var tipoGrafica = $('select[name=tipo2]').val();
        var _token = $("input[name=_token]").val();
        console.log(contenido,titulo,descripcion,tipoGrafica,_token);
        //Enviar la informacion del formulario al controlador mediante la ruta 'usuarios.registrar'
        $.ajax({
          url: "<?php echo e(route('store')); ?>",
          type: "POST",
          //Informacion almacenada enviada al controlador
          data:{
            titulo: titulo,
            descripcion: descripcion,
            tipoGrafica: tipoGrafica,
            contenido: contenido,
            _token:_token
          },
          success:function(response){
            if(response){
              $('#registro-grafica')[0].reset();
              toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});//Mostrar mensaje cuando el registro se cree correctamente
              $('#tabla-usuario').DataTable().ajax.reload();//Recargar la tabla de usuarios
            }
          }
        });
      });
    });
  </script>
  <script>
    //objeto para almacenar datos a mostrar
    var objeto;
    function setObjeto(obj){
        objeto=obj;
    }
    function getObjeto(){
        return objeto;
    }
    
  </script>
  <script>
        function graficar3(yourArray,tipo,titulo){
            var tipo = tipo;
            console.log(tipo);
            var titulo = titulo;
            console.log(titulo);
        $(function () {
            //yourArray.foreach(x=>{console.log(x)});
            
        /**
        * Use external CSV parser
        * http://papaparse.com/
        */
        var newCsv;
        try {
            newCsv = Papa.unparse(yourArray);
        }
        catch (e) {
            newCsv = yourArray;
        }
        var csv = Papa.parse(newCsv);
        
        //console.log("papaparse")
        //console.log(csv);
        $('#container3').highcharts({

            data: {
                rows: csv.data,
                seriesMapping: [{
                    // x: 0, // X values are pulled from column 0 by default
                    // y: 1, // Y values are pulled from column 1 by default
                    //label: 2 // Labels are pulled from column 2 and picked up in the dataLabels.format below
                }]
            },
            credits: {
                enabled: false
            },
            chart: {
                type: tipo
            },
            title: {
                text: titulo
            },
            xAxis: {
                minTickInterval: 24 * 36e5
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    format: '{value} '
                }
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                layout: 'vertical',
                x: 0,
                y: 100
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.label}'
                    },
                    tooltip: {
                        valueSuffix: ' '
                    }
                }
            }

        });
        });

    }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\Proyecto 5TO Ciclo\observatorio\proyectoTurismo\resources\views/admin/graficas.blade.php ENDPATH**/ ?>