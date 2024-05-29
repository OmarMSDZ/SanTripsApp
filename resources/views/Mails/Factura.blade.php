@extends('layouts.correo_layout')
@section('title', 'Factura')

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
        
        @if ($user)
            <h2 id="saludo" style="color:black; margin-top:10px;">¡Saludos! <br>{{ $user->name }}</h2>
          @else  
            <h2 id="error">ERROR: Usuario no encontrado</h2>
          @endif  
    </div>
    <hr>
    <div id="reserva">
        <h4 id="titulo" style="color:black;">Factura No° {{$factura->numero}} <br> {{$factura->fecha}}</h4>
        <hr>
        <div id="detalles">
            <div id="infoPaquete">
                <p style="color:black;"><b>Informacion del Paquete Reservado</b></h4>
                <hr>
                <p style="color:black;"><b>Nombre del Paquete reservado:</b> {{$paqueteReserva->nombre}}</p>
                <p style="color:black;"><b>Categoria:</b> {{$paqueteReserva->categoria}}</p>
                <p style="color:black;"><b>Costo/Persona:</b> USD ${{$paqueteReserva->costo}}</p>
                <p style="color:black;"><b>Descuento Aplicado:</b> {{$paqueteReserva->porciento}}%</p> 
            </div>
            <div id="datosReserva">
                <p style="color:black;"><b>Informacion de Pago</b></p>
                <hr>
                <p style="color:black;"><b>Fecha Seleccionada para la reserva:</b> {{$paqueteReserva->fechaseleccionada}}</p> 
                <p style="color:black;"><b>Cantidad de Personas:</b> {{$paqueteReserva->cantpersonasreserva}}</p>  
                <p style="color:black;"><b>Monto Total (Sin Descuentos):</b> USD ${{($paqueteReserva->cantpersonasreserva)*($paqueteReserva->costo)}}</p>  
                <p style="color:black;"><b>Descuentos:</b> USD ${{$factura->descuentos}}</p>  
                <p style="color:black;"><b>Monto Total:</b> USD ${{$factura->monto}}</p>  
                <p style="color:black;"><b>Pendiente:</b> USD ${{$factura->montopendiente}}</p>  
                <p style="color:black;"><b>Pago realizado utilizando:</b> PayPal</p>  
                
            </div>
        </div>
    </div>
    <hr>
    <div id="codigoValidacion">
        <p style="color:black;">Facturado el día <b>{{$factura->fecha}}</b></p>
        <p style="color:black;">SanTrips</p>
    </div>
</div>

@endsection

@section('footer')
        
@endsection
