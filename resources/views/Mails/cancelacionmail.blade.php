@extends('layouts.correo_layout')
@section('title', 'Cancelación de reserva')

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
        @if ($cancelacion)
            <h2 id="saludo" style="color:black; margin-top:10px;">¡Has cancelado tu reserva! <br>{{ $cancelacion->nombresUsuario ?? 'Usuario no encontrado' }} {{ $cancelacion->apellidosUsuario ?? '' }}</h2>
        @else  
            <h2 id="error">ERROR: Cancelación no encontrada</h2>
        @endif  
    </div>
    <hr>
    <div id="reserva">
        @if ($cancelacion)
            <h4 id="titulo" style="color:black;">Cancelación de reserva del usuario {{ $cancelacion->nombresUsuario ?? 'Nombres no disponibles' }} {{ $cancelacion->apellidosUsuario ?? 'Apellidos no disponibles' }}</h4>
            <hr>
            <div id="detalles">
                <div id="infoPaquete">
                    <p style="color:black;"><b>Información de la cancelación de la reserva</b></h4>
                    <hr>
                    <p style="color:black;"><b>Motivo:</b> {{ $cancelacion->motivo ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Acepta:</b> {{ $cancelacion->acepta ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Monto Total:</b> {{ $cancelacion->monto ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Fecha Seleccionada:</b> {{ $cancelacion->fecha ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Id de reservación:</b> {{ $cancelacion->reservacion ?? 'No disponible' }}</p>
                </div>
                <div id="datosReserva">
                    <p style="color:black;"><b>Información del usuario</b></p>
                    <hr>
                    <p style="color:black;"><b>Nombres:</b> {{ $cancelacion->nombresUsuario ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Apellidos:</b> {{ $cancelacion->apellidosUsuario ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Teléfono:</b> {{ $cancelacion->telefonoUsuario ?? 'No disponible' }}</p>
                    <p style="color:black;"><b>Email:</b> {{ $cancelacion->emailUsuario ?? 'No disponible' }}</p>
                </div>
            </div>
            <hr>
        @else
            <p style="color:black;">No se encontró la información de la cancelación.</p>
        @endif
    </div>
</div>
@endsection
