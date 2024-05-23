<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SanTrips - Agencia de viajes</title>
    <link rel="shortcut icon" href="{{asset('img/SanTrips (logo azul).svg')}}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/cssuser.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
{{-- para lo de paypal --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=DOP&intent=capture"></script>
</head>
<style>
    /*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
    #header {
        transition: all 0.5s;
        background: #fff;
        z-index: 997;
        padding: 15px 0;
        border-bottom: 1px solid #e6f2fb;
    }

    #header.header-scrolled {
        border-color: #fff;
        box-shadow: 0px 2px 15px rgba(18, 66, 101, 0.08);
    }

    #header .logo {
        font-size: 28px;
        margin: 0;
        padding: 0;
        line-height: 1;
        font-weight: 300;
        letter-spacing: 0.5px;
        font-family: "Poppins", sans-serif;
    }

    #header .logo a {
        color: #16507b;
    }

    #header .logo img {
        max-height: 40px;
    }

    @media (max-width: 992px) {
        #header .logo {
            font-size: 28px;
        }
    }

    /*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
    /**
* Desktop Navigation
*/
    .navbar {
        padding: 0;
    }

    .navbar ul {
        margin: 0;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
    }

    .navbar li {
        position: relative;
    }

    .navbar a,
    .navbar a:focus {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0 10px 30px;
        font-size: 14px;
        color: #16507b;
        white-space: nowrap;
        transition: 0.3s;
    }

    .navbar a i,
    .navbar a:focus i {
        font-size: 12px;
        line-height: 0;
        margin-left: 5px;
    }

    .navbar a:hover,
    .navbar .active,
    .navbar .active:focus,
    .navbar li:hover>a {
        color: #2487ce;
    }

    .navbar .getstarted,
    .navbar .getstarted:focus {
        background: #2487ce;
        padding: 8px 20px;
        margin-left: 30px;
        border-radius: 4px;
        color: #fff;
    }

    .navbar .getstarted:hover,
    .navbar .getstarted:focus:hover {
        color: #fff;
        background: #3194db;
    }

    .navbar .dropdown ul {
        display: block;
        position: absolute;
        left: 14px;
        top: calc(100% + 30px);
        margin: 0;
        padding: 10px 0;
        z-index: 99;
        opacity: 0;
        visibility: hidden;
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
        transition: 0.3s;
        border-radius: 4px;
    }

    .navbar .dropdown ul li {
        min-width: 200px;
    }

    .navbar .dropdown ul a {
        padding: 10px 20px;
        text-transform: none;
    }

    .navbar .dropdown ul a i {
        font-size: 12px;
    }

    .navbar .dropdown ul a:hover,
    .navbar .dropdown ul .active:hover,
    .navbar .dropdown ul li:hover>a {
        color: #2487ce;
    }

    .navbar .dropdown:hover>ul {
        opacity: 1;
        top: 100%;
        visibility: visible;
    }

    .navbar .dropdown .dropdown ul {
        top: 0;
        left: calc(100% - 30px);
        visibility: hidden;
    }

    .navbar .dropdown .dropdown:hover>ul {
        opacity: 1;
        top: 0;
        left: 100%;
        visibility: visible;
    }

    @media (max-width: 1366px) {
        .navbar .dropdown .dropdown ul {
            left: -90%;
        }

        .navbar .dropdown .dropdown:hover>ul {
            left: -100%;
        }
    }
</style>

<body id="top">



    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="{{ route('inicio') }}" class="logo"><img src="{{ asset('img/SanTrips (logo azul).svg') }}"
                    alt="" class="img-fluid"></a>
 

            <nav id="navbar" class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNav">
                        <ul class="navbar-nav ">
                            <li class="nav-item"><a class="nav-link scrollto" href="{{ route('inicio') }}">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link scrollto" href="{{ route('inicio') }}#about">Sobre Nosotros</a></li>
                            <li class="nav-item"><a class="nav-link scrollto" href="{{ route('paquetes_turisticos') }}">Paquetes Turísticos</a></li>
                            <li class="nav-item"><a class="nav-link scrollto" href="{{ route('reservas_realizadas') }}">Mis Reservas</a></li>
                            <li class="nav-item"><a class="nav-link scrollto" href="{{ route('inicio') }}#contact">Contacto</a></li>
                           
                            @auth
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item"><a class="nav-link scrollto" href="{{ route('register') }}">Registro</a></li>
                                <li class="nav-item"><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav><!-- .navbar -->




        </div>
    </header><!-- End Header -->
