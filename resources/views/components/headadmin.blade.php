<!doctype html>
<html lang="en">
    <head>
        <title>AdminSantrips</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('css/cssadmin.css') }}">
         
        <!-- Include the ECharts file you just downloaded
      Para los graficos con ECharts -->
    <script src="{{ asset('js/echarts.js') }}"></script>


    </head>

    <body>


        <header>
            
             <!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-gradient bg-primary">
    <div class="media d-flex align-items-center"><img src="{{ asset('img/SanTrips.svg') }}" alt="..." width="65" height="65" class="mr-3  img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class=" mx-3 text-light">SANTRIPS</h4>
        <!-- <p class="font-weight-light text-muted mb-0">Web developer</p> -->  
      </div>
    </div>
  </div>

  <p class=" font-weight-bold text-uppercase px-3 small pb-4 mb-0">Administración del sitio</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      {{-- Las rutas se llaman con el name --}}
      <a href="{{ Route('adminmenu/dashboard')}}" class="nav-link text-dark font-italic">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Dashboard
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('adminusuarios')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Usuarios
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('empleados.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Empleados
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('Paquetes.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Paquetes Turisticos
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('destinos.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Destinos
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('empresasProveedoras.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Empresas Proveedoras
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('vehiculos.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Vehículos
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('reservashechas.index')}}"class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Reservas
            </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('pagos.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Pagos
            </a>
    </li>
     {{--  <li class="nav-item">
    <a href="{{ Route('incidentesadmin.index')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Incidentes
            </a>
    </li> --}}
    
    
    <li class="nav-item">
      <a href="{{ Route('adminvarias')}}" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Extras
            </a>
    </li>

    <br>
    <br>
    <br>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark font-italic ">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>

                <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-responsive-nav-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log Out') }}
                  </x-responsive-nav-link>
              </form>


           
            </a>
    </li>


  </ul>
 
</div>
<!-- End vertical navbar -->
</header>


  
   
 