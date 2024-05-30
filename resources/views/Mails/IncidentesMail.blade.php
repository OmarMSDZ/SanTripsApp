@extends('layouts.correo_layout')
@section('title', 'Incidentes')

@section('css')
<style>
    #container {
        width: 50em;
        border: 3px solid black;
        border-radius: 20px;
        color: black;
    }
    #header {
        text-align: center;
    }
    #logo {
        height: 250px;
        width: 250px;
    }
    #saludo {
        text-align: center;
    }
    #error {
        color: red;
        text-align: center;
    }
    #reserva {
        text-align: center;
    }
    #titulo {
        text-align: center;
    }
    #detalles {
        display: flex;
        justify-content: space-between;
    }
    #infoPaquete {
        width: calc(50% - 10px);
        padding-right: 5px;
    }
    #datosReserva {
        width: calc(50% - 10px);
        padding-left: 5px;
    }
    #codigoValidacion {
        text-align: center;
    }
    #codigo {
        color: red;
    }
</style>
@endsection

@section('content')
<div id="container">
    <div id="header">
        @if ($incidente)
            <h2 id="saludo" style="color:black; margin-top:10px;">¡Ha reportado un incidente! <br>{{ $incidente->nombresUsuario ?? 'Usuario no encontrado' }} {{ $incidente->apellidosUsuario ?? '' }}</h2>
        @else  
            <h2 id="error">ERROR: Incidente no encontrado</h2>
        @endif  
    </div>
    <hr>
    <div id="reserva">
        @if ($incidente)
            <h4 id="titulo" style="color:black;">Reporte del usuario {{ $incidente->nombresUsuario ?? 'Nombres no disponibles' }} {{ $incidente->apellidosUsuario ?? 'Apellidos no disponibles' }}</h4>
            <hr>
            <div id="detalles">
                <div id="infoPaquete">
                    <p style="color:black;"><b>Información del Incidente realizado</b></h4>
                    <hr>
                    <p style="color:black;"><b>Fecha ocurrida:</b> {{ $incidente->fechaIncidente ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Descripción:</b> {{ $incidente->descripcionIncidente ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Tipo de incidente:</b> {{ $incidente->tipoIncidente ?? 'No disponible' }}</p>
                </div>
                <div id="datosReserva">
                    <p style="color:black;"><b>Información del usuario</b></p>
                    <hr>
                    <p style="color:black;"><b>Nombres:</b> {{ $incidente->nombresUsuario ?? 'No disponible' }}</p> 
                    <p style="color:black;"><b>Apellidos:</b> {{ $incidente->apellidosUsuario ?? 'No disponible' }}</p>  
                    <p style="color:black;"><b>Teléfono:</b> {{ $incidente->telefonoUsuario ?? 'No disponible' }}</p>  
                    <p style="color:black;"><b>Email:</b> {{ $incidente->emailUsuario ?? 'No disponible' }}</p>  
                </div> 
            </div>
        @else
            <p id="error">No se encontraron datos del incidente.</p>
        @endif
    </div>
    <hr>
    <div id="codigoValidacion">
        <p style="color:black;">Enviado el día <b>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</b></p>
        <p style="color:rgb(5, 60, 177);"><b>SanTrips</b></p>
    </div>
</div>
@endsection

@section('footer')
@endsection
