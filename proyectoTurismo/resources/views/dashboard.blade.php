@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="header">
        <h1>Manual de administración</h1>
    </div>
@stop

@section('content')
    <div class="manual">
        <p>Bienvenido al manual de instrucciones, aquí se le explicará a detalle como funciona cada módulo del sistema.</p>
        <p>El manual esta realizado de forma textual y además visual a través de un video en Youtube como se muestra acontinuación:</p>
        <div>
            
            <h4>Video explicativo del panel de administración :</h4>
            
            <div class="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/yhcmkwcZY7k" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <section>
            <h3>Gestión de usuarios</h3>
            <p>En este apartado de la gestión de usuarios, usted tendrá la posibilidad de asignar todos los usuarios autorizados a la parte administrativa con sus respectivas credenciales. En el siguiente formulario completando la información 
                solicitada (nombres, correo y contraseña), el usuario ya estará registrado.
            </p>
            <p class="text-danger">¡Atención!
                No podrá ingresar un usuario con un correo que ya ha sido ingresado en el sistema.
            </p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen4.png')}}" alt="Lista de usuarios">
            </div>
            <p>Una vez registrado el usuario, podrá observar todo el listado de usuarios con su respectiva información mediante una tabla muy completa que le ofrece opciones como mostrar un determinado número de registros, filtro de búsqueda y paginación. Además, en caso de haber ingresado incorrectamente la información de un usuario, tiene opciones como <b>EDITAR</b> y <b>ELIMINAR</b>.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen1.png')}}" alt="Lista de usuarios">
            </div>
            <p>Para editar la información de algún usuario en especifíco, únicamente tendrá que presionar el botón de <b>EDITAR</b> ubicado en la parte derecha de la tabla. Cuando presione el botón le aparecerá una ventana modal con los datos del usuario, donde puede realizar los cambios que desee y para realizar el cambio presiona el botón de <b>ACTUALIZAR</b> y en caso de no querer realizar ningún cambio utiliza el botón de <b>CANCELAR</b>.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen2.png')}}" alt="Lista de usuarios">
            </div>
            <p>Por otra parte, para eliminar un usuario tendrá que presionar el botón de <b>ELIMINAR</b> donde se le mostrará una ventana de confirmación, ya que puede suceder que haya presionado el botón por equivocación. Para confirmar la eliminación presiona otra vez el botón de <b>ELIMINAR</b> pero en caso de que haya sido un error, el botón de <b>CANCELAR</b></p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen3.png')}}" alt="Lista de usuarios">
            </div>
        </section>
        <section>
            <h3>Gestión de lugares turísticos</h3>
            <p>Esta sección funciona de manera muy similar a la sección de usuarios, con las mismas funciones e interfaz. Lo principal que cambia son los campos que se deben completar para registrar un nuevo lugar turístico.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen8.png')}}" alt="Lista de usuarios">
            </div>
            <p>En el campo de <b>TIPO</b> se muestran 4 opciones que consideramos que son las más relevantes (Hoteles, iglesias, restaurantes y parques).</p>
            <div class="manual-imagen-mini">
                <img src="{{asset('img/admin/imagen9.png')}}" alt="Lista de usuarios">
            </div>
            <p>La categoria se han asignado valores desde 1 hasta 5. Representando 5 la calidad máxima y 1 la calidad mínima.</p>
            <div class="manual-imagen-mini">
                <img src="{{asset('img/admin/imagen10.png')}}" alt="Lista de usuarios">
            </div>
            <p>Para subir la imagen, presiona el botón de <b>EXAMINAR</b>, el cual mostrará el siguiente recuadro para que busque la imagen en su ordenador que quiera asignar al lugar turístico.</p>
            <div class="manual-imagen-mini">
                <img src="{{asset('img/admin/imagen11.png')}}" alt="Lista de usuarios">
            </div>
            <p>Una vez seleccionada la imagen respectiva, se mostrará en el recuadro de la parte derecha.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen12.png')}}" alt="Lista de usuarios">
            </div>
            <p>En los dos útlimos campos, que son "Descripción" y "Contenido" la diferencia es que la descripción es muy breve que se muestra en el listado de todos los hoteles, parques o iglesias. Por otra parte, el contenido es la información a detalle de cada uno de los lugares turísticos</p>
            <p>Al igual que la sección anterior, cuenta con las opciones fundamentales de <b>EDITAR</b> y <b>ELIMINAR</b> ubicadas en la parte derecha de la tabla.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen6.png')}}" alt="Lista de usuarios">
            </div>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen7.png')}}" alt="Lista de usuarios">
            </div>
        </section>
        <section>
            <h3>Carga de archivos</h3>
            <p>Esta sección es muy intuitiva, en la parte superior se encuentra un marco donde se suben todos los archivos de los hoteles y como se muestra en el texto, solo tiene que arrastrar en ese campo los archivos que desea subir o tambien si hace click en cualquier parte dentro del recuadro, se abrirá una ventana para que seleccione los archivos.</p>
            <p class="text-danger">¡Atención!
                El sistema solo aceptará archivos excel, es decir, con extension xls o xlsx.
            </p>
            <p>La tabla de la parte inferior muestra todos los archivos que han sido cargados en el sistema y en caso de que ya no se necesite de algún archivo lo podrá eliminar para que ya no ocupe espacio en la memoria.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen13.png')}}" alt="Lista de usuarios">
            </div>
        </section>
        <section>
            <h3>Visualizar registros</h3>
            <p>La única función de este apartado es mostrar todos los registros de los archivos cargados previamente. Los registros estan ordenados de acuerdo a cada hotel.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen14.png')}}" alt="Lista de usuarios">
            </div>
        </section>
        <section>
            <h3>Gestión de métricas</h3>
            <p>En este apartado usted podrá crear cualquier tipo de métrica que desee, siempre y cuando utilice las operaciones básicas que son: suma, resta, multiplicación y división. Completando los campos requeridos y seleccionando las columnas con las que requiere operar ya tendrá como resultado una nueva métrica</p>
            <p class="text-danger">¡Atención!
                Debe tener en cuenta que el sistema resolverá la operación teniendo en cuenta el orden de las operaciones matemáticas.
            </p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen15.png')}}" alt="Lista de usuarios">
            </div>
            <p>Usted podrá agregar cualquier cantidad de columnas que desee, únicamente presionando el botón de <b>AGREGAR</b> y en caso de haber agregado por erro, también podrá quitar las columnas con el botón de <b>REMOVER</b></p>
            <div class="manual-imagen-mini">
                <img src="{{asset('img/admin/imagen19.png')}}" alt="Lista de usuarios">
            </div>
            <p>Al igual que las demás secciones, se muestra todo el listado de métricas registradas con sus respectivas opciones de <b>EDITAR</b> y <b>ELIMINAR</b></p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen18.png')}}" alt="Lista de usuarios">
            </div>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen16.png')}}" alt="Lista de usuarios">
            </div>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen17.png')}}" alt="Lista de usuarios">
            </div>
            <p>Una vez creada la métrica, cualquier usuario podrá hacer uso de ella en el apartado de gráficas sin ningún tipo de problema.</p>
            <div class="manual-imagen">
                <img src="{{asset('img/admin/imagen20.png')}}" alt="Lista de usuarios">
            </div>
        </section>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop