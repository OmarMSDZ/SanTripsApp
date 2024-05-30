@extends('layouts.correo_layout')
@section('title', 'Ticket Electronico')

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
        {{-- <img src="https://drive.google.com/file/d/1h9AINRjf31fahU7wvvWNNGI81etqIqE3/view?usp=sharing" alt="" id="logo"> --}}
        @if ($user)
            <h2 id="saludo" style="color:black;">¡Saludos! <br>{{ $user->name }}</h2>
        @else
            <h2 id="error">ERROR: Usuario no encontrado</h2>
        @endif
    </div>
    <hr>
    <div id="reserva">
        <h3 id="titulo" style="color:black;">Detalles de la Reserva</h3>
        <hr>
        <div id="detalles">
            <div id="infoPaquete">
                <p style="color:black;">Informacion del Paquete Reservado</h4>
                <hr>
                <h4 style="color:black;"><b>Nombre del Paquete:</b> {{$paqueteReserva->nombre}}</h4>
                <h4 style="color:black;"><b>Descripción del Paquete:</b> {{$paqueteReserva->descripcion}}</h4>
                <h4 style="color:black;"><b>Categoria:</b> {{$paqueteReserva->categoria}}</h4>
                <h4 style="color:black;"><b>Costo/Persona:</b> USD ${{$paqueteReserva->costo}}</h4>
                <h4 style="color:black;"><b>Max. Personas:</b> {{$paqueteReserva->numpersonas}}</h4>
                <h4 style="color:black;"><b>Edades:</b> {{$paqueteReserva->edades}}</h4>
                <h4 style="color:black;"><b>Idiomas:</b> {{$paqueteReserva->idiomas}}</h4>
                <h4 style="color:black;"><b>Alojamiento:</b> {{$paqueteReserva->alojamiento}}</h4>
                <h4 style="color:black;"><b>Hora de Inicio:</b> {{$paqueteReserva->horainicio}}</h4>
                <h4 style="color:black;"><b>Tiempo Estimado:</b> {{$paqueteReserva->tiempoestimado}}</h4>
                <h4 style="color:black;"><b>Descuento Aplicado:</b> {{$paqueteReserva->porciento}}%</h4>
            </div>
            <div id="datosReserva">
                <p style="color:black;">Datos de Esta Reservación</p>
                <hr>
                <h4 style="color:black;"><b>Fecha Seleccionada:</b> {{$paqueteReserva->fechaseleccionada}}</h4>
                <h4 style="color:black;"><b>Cantidad de Personas:</b> {{$paqueteReserva->cantpersonasreserva}}</h4>
                <h4 style="color:black;"><b>Monto Total a Pagar:</b> USD ${{$paqueteReserva->montototal}}</h4>
                <h4 style="color:black;"><b>Estado de la Reservación:</b> {{$paqueteReserva->estadoreservacion}}</h4>
            </div>
        </div>
    </div>
    <hr>
    <div id="codigoValidacion">
        <h3 style="color:black;">Su Código de Validación Es: <span id="codigo">{{$ticket->codigo}}</span></h3>
        <p style="color:black;">Para Validar esta Reservación, dirijase junto a las personas que irán con usted a uno de los encargados del tour, 
        este validará el código y podrá proceder a disfrutar de la experiencia!</p>
        <h4 style="color:black;"><b>Encargado de este paquete:</b> {{$ticket->nombreempleado}} {{$ticket->apellidoempleado}}</h4>
        <h4 style="color:black;"><b>Teléfono:</b> {{$ticket->telefonoempleado}}</h4>
        <h4 style="color:black;"><b>Email:</b> {{$ticket->emailempleado}}</h4>
    </div>
</div>

@endsection

@section('footer')
        
@endsection

