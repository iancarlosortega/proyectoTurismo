

<?php $__env->startSection('title', 'Graficas'); ?>

<?php $__env->startSection('content_header'); ?>
        
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <h1>Gestión de gráficas tt</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Gráficas</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear Gráfica</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table id="tabla-usuario" class="table table-hover">
            <thead>
                <td>ID</td>
                <td>Nombre</td>
                <td>Email</td>
                <td>Acciones</td>
            </thead>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h3>Crear Gráfica</h3>
        <form id="registro-usuario">
            <?php echo csrf_field(); ?>
            <div class="form-group">
            <label for="exampleInputName">Título</label>
            <input type="text" class="form-control" id="registrarNombre" name="registrarNombre">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Descripción</label>
                <input type="text" class="form-control" id="registrarNombre" name="registrarNombre">
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
                <select id="tipoGrafica" class="form-select" aria-label="Default select example">
                    <option value="line">Lineas</option>
                    <option value="spline">spline</option>
                    <option value="area">area</option>
                    <option value="areaspline">area spline</option>
                    <option value="column">columna</option>
                    <option value="bar">barra</option>
                    <option value="pie">circular</option>
                    <option value="scatter">dispersion</option>
                    <option value="gauge">indicador</option>
                    <option value="arearange">rango de area</option>
                    <option value="areasplinerange">rango de linea</option>
                    <option value="columnrange">rango de columna</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Agrupar por columna:</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="1">Huéspedes</option>
                    <option value="2">Ocupación</option>
                    <option value="3">Tarifa Promedio</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Filtrar según qué fecha:</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="1">Mes</option>
                    <option value="2">Meses</option>
                    <option value="3">Año</option>
                </select>
            </div>
            <pre id="jsondata"></pre>
            <button type="submit" class="btn btn-primary" onclick="return myFunction()">Crear</button>
            <button type="submit" class="btn btn-primary" onclick="return exportarImg()">guardar grafica</button>
            <button type="submit" class="btn btn-primary" onclick="return encabesado()">payaa</button>
            <button type="submit" class="btn btn-primary" onclick="return getHeaders()">option</button>

            
        </form>
    </div>
        
<select id="selectElementId">
    
<select>
<div id="container" style="height: 400px"></div>

<div id="tt">
    <input type="checkbox" name="select-all" id="select-all" />

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>		
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
        function exportarImg(){
        var chart = $('#container').highcharts();
        chart.exportChart({
        type: 'png',
        filename: 'my-pdf',
        url:'upload',
        formAttributes:("X-CSRF-Token", "<?php echo e(csrf_token()); ?>")
        });
        return false;
        }
    </script>
    <script>
    function encabesado(){
        var e = document.getElementById("ddlViewBy");
        var strUser = e.value;
        var url = "/storage/public/"+strUser;
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
        var ruta = "../storage/public/${strUser}";
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
        var csv = Papa.parse(newCsv);

        //console.log("papaparse")
        //console.log(csv);
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
                        valueSuffix: ' km'
                    }
                }
            }

        });
        });

    }
    function xlsToCsv1(name,tipo,yourArray){
        console.log("xls")
        var url = "../storage/public/"+name;
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ispa1\OneDrive\Documentos\GitHub\ProyectoTuristicoUTPL5Ciclo\proyectoTurismo\resources\views/admin/graficas.blade.php ENDPATH**/ ?>