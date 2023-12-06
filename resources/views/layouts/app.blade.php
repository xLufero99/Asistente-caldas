<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Metadatos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Título -->
    <title>Asistente Caldas</title>
    <!-- Fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts (usando Vite) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Estilos en línea -->
    <style>
        #logo {
            height: 68px;
            width: 450px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        #logoud {
            height: 65px;
            width: 90px;
        }
        .custom-label {
            font-size: 30px;
            color: white;
        }
        #aingresos {
            color: green;
        }
        #aegresos {
            color: red;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div id="logo">
            <img src="{{ asset('logowhite.png') }}" id="logoud" alt="Logo">
                <label class="custom-label">Asistente Caldas</label>
            </div>
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Elementos del lado izquierdo de la barra de navegación -->
                    <ul class="navbar-nav me-auto">
                        <!-- Los elementos del lado izquierdo van aquí -->
                    </ul>
                    <!-- Elementos del lado derecho de la barra de navegación -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Enlaces de autenticación -->
                        @guest
                            @if (Route::has('login'))
                                <!-- Enlace de inicio de sesión -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <!-- Enlace de registro -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Enlace a Ingresos -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ingresos.index') }}" id="aingresos">Ingresos</a>
                            </li>
                            <!-- Enlace a Egresos -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('egresos.index') }}" id="aegresos">Egresos</a>
                            </li>
                            <!-- Menú desplegable de usuario -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <!-- Menú desplegable -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Enlace de cierre de sesión -->
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <!-- Formulario de cierre de sesión -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Contenido principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
