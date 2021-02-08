<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    @yield('css')
    
</head>

<body>
    <header>
        <a class="logo" href="/"><img src="{{asset('img/logoObtur.png')}}" alt="logo"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="{{route('index')}}">Inicio</a></li>
                    <li class="dropdown">
                        <button class="dropbtn">Lugares Turisticos</button>
                        <div class="dropdown-content">
                          <a href="{{route('lugaresTuristicos.parques')}}">Parques</a>
                          <a href="{{route('lugaresTuristicos.hoteles')}}">Hoteles</a>
                          <a href="{{route('lugaresTuristicos.restaurantes')}}">Restaurantes</a>
                          <a href="{{route('lugaresTuristicos.iglesias')}}">Iglesias</a>
                        </div>
                    </li>
                    <li><a href="{{route('visualizaciones')}}">Visualizaciones</a></li>
                    <li><a href="{{route('quienesSomos')}}">¿Quiénes somos?</a></li>
                </ul>
            </nav>
            @if (Route::has('login'))

                @auth

                <a href="{{ url('/admin/usuarios') }}" class="cta">Dashboard</a>

            @else
                <a class="cta" href="{{ route('login') }}">Iniciar Sesión</a>

                @endauth
            @endif
            
    </header>
    @yield('body')
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
                    <img src="{{asset('img/iconoDireccion.png')}}" alt="iconoDireccion">
                    <p>Dirección  :  San Cayetano Alto - Loja</p>
                </div>
                <div>
                    <img src="{{asset('img/iconoTelefono.png')}}" alt="iconoTelefono">
                    <p>Teléfono  :  0999565400</p>
                </div>
                <div>
                    <img src="{{asset('img/iconoCorreo.png')}}" alt="iconoCorreo">
                    <p>Correo Electrónico  :  icortega@utpl.edu.ec</p>
                </div>
                
    
            </div><div class="aboutUs">
                <h2>SOBRE NOSOTROS</h2>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit
                amet turpis venenatis nulla dignissim scelerisque. Ut volutpat maximus
                ligula.</p>
                <div class="redes">
                    <img class="inline-block" src="{{asset('img/iconoFacebook.png')}}" alt="iconoFacebook">
                    <img class="inline-block" src="{{asset('img/iconoTwitter.png')}}" alt="iconoTwitter">
                    <img class="inline-block" src="{{asset('img/iconoYoutube.png')}}" alt="iconoYoutube">
                    <img class="inline-block" src="{{asset('img/iconoInstagram.png')}}" alt="iconoInstagram">
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="{{asset('js/app.js')}}"></script>
@yield('js')
</html>