<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link rel="stylesheet" href="{{asset('css/materialize-icons.css')}}">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css')}}" media="screen,projection" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">  --}}

    <title>@yield('title')</title>
</head>

<body>
    <header>
        {{-- NAVBAR --}}
        <nav class="white">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo"><img class="responsive-img" style="max-height: 60px;" src="{{secure_asset('logo.svg') }}" alt="Logo NCIE"></a>
                    <a href="#" data-target="slide-out" class="sidenav-trigger">
                        <i class="material-icons black-text text-black">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li><a class="black-text text-black" href="{{ route("qr.index") }}">Leer QR</a></li>
                        <li><a class="black-text text-black" href="{{ route("users.index") }}">Usuarios</a></li>
                        <li><a href="{{ route('booking_articles.index') }}" class="black-text text-black" href="{{ route("booking_articles.index") }}">Prestamos</a></li>
                        <li><a class="black-text text-black" href="{{ route("booking_cubicules.index") }}">Cubículos</a></li>
                        @auth
                            <li><a class="black-text text-black" href="{{ route("warehouse.index") }}">Almacén</a></li>
                            <li><a class="black-text text-black" href="{{ route("logout") }}">Cerrar Sesión</a></li>
                            @endauth
                            @guest
                            <li><a class="black-text text-black" href="{{ route("login") }}">Iniciar Sesión</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        {{-- END NAVBAR --}}
        {{-- SIDEBAR --}}
        <ul class="sidenav sidenav-fixed hide-on-large-only" id="slide-out">
            <li><a href="#">Leer QR</a></li>
            <li><a href="{{ route("users.index") }}">Usuarios</a></li>
            <li><a href="{{ route("booking_articles.index") }}">Prestamos</a></li>
            <li><a href="#">Cubículos</a></li>
            @auth
                <li><a href="{{ route("warehouse.index") }}">Almacén</a></li>
                <li><a href="{{ route("logout") }}">Cerrar Sesión</a></li>
            @endauth
            @guest
                <li><a href="{{ route("login") }}">Iniciar Sesión</a></li>
            @endguest
        </ul>
        {{-- END SIDEBAR --}}
    </header>
    {{-- END NAVBAR --}}

    {{-- CONTENT --}}
    <div class="section">
        @yield('content')
    </div>
    {{-- END CONTENT --}}

    {{-- SCRIPTS --}}
    <!--JavaScript at end of body for optimized loading-->

    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/typeahead.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/materialize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/material-dialog.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>
    <script src="{{ asset('/js/tippy.min.js') }}"></script>
    @yield('scripts')
    <script>
        M.AutoInit();
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.datepicker').datepicker({
                disableWeekends: true,
                format: "yyyy-mm-dd",
                i18n:{
                    cancel: "Cancelar",
                    firstDay:0,
                    months:[
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ],
                    monthsShort:[
                        'Ene',
                        'Feb',
                        'Mar',
                        'Abr',
                        'May',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dic'
                    ],
                    weekdays:[
                        'Domingo',
                        'Lunes',
                        'Martes',
                        'Miercoles',
                        'Jueves',
                        'Viernes',
                        'Sábado',
                    ],
                    weekdaysShort:[
                        'Dom',
                        'Lun',
                        'Mar',
                        'Mier',
                        'Jue',
                        'Vie',
                        'Sáb',
                    ],
                    weekdaysAbbrev: ['D','L','M','M','J','V','S']
                }
            });
        });

    </script>
    {{-- END SCRIPTS --}}
</body>