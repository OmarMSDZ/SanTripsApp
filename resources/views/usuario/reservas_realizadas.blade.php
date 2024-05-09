 

    <x-headusuario></x-headusuario>
   
     <style>
        .contenido{
            margin-top: 10em;
            margin-bottom: 10em;
        }
        .user-profile img{
            width: 124px;
            height: 124px;
            
        }
     </style>
     <main class="contenido">

        <div class="container mt-15">
            <h1>Mis Reservas</h1>
            <hr>

        <h3>Mostrar por Estado</h3>
        <select name="estado" id="" class="form-select">

            <?php 
                $estados = DB::select("SELECT IdEstadoReservacion, EstadoReservacion FROM estado_reservacion;");
            ?>
@foreach ($estados as $estado)
            <option value="{{$estado->IdEstadoReservacion}}">{{$estado->EstadoReservacion}}</option>
@endforeach
        </select>
        <!-- Sección de perfil del usuario -->


        {{-- Esto se debe de hacer con el id del usuario que inicie sesion --}}
        <?php 
           $usuarios = DB::select("SELECT id, name, email FROM users WHERE id=2");
           
        ?> 
        @foreach ($usuarios as $usuario)
            
        
        <div class="user-profile">
            <img src="{{asset('img/favicon.png')}}" alt="Foto de perfil" >
            <div class="user-info">
                <h2>Usuario</h2>
                <p hidden>{{$usuario->id}}</p>
                <p>Nombre: {{$usuario->name}}</p>
                <p>Email: {{$usuario->email}}</p>
                <!-- Agrega más información del perfil según sea necesario -->
                @endforeach    
            </div>
        </div>
    

        
        <style>
             .table-container {
    
    overflow-x: auto; /* Activar la barra de desplazamiento horizontal si es necesario */
    overflow-y: auto; /* Activar la barra de desplazamiento vertical si es necesario */
}
table {
    width: 100%; /* Para que la tabla ocupe todo el ancho del contenedor */
    border-collapse: collapse;
}
        </style>
            <div class="table-container">
            <table class="table table-responsive" style="overflow: auto; position: sticky;">
                <thead>
                    <tr> 
                        <th>No.Reserva</th>
                        <th>Nombre del Paquete</th>
                        <th>Fecha Inicio Reserva</th>
                        <th>Fecha Fin Reserva</th>
                        <th>N° Personas</th>
                        <th>Metodo de Pago</th>
                        <th>Estado de la Reserva</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="table-hover">

                    {{-- aqui deberia de traer las reservas realizadas por un usuario especifico --}}
                    <?php 
                    $reservas = DB::select("SELECT 
                    r.IdReservacion, 
                    p.Nombre, 
                    r.FechaDesde, 
                    r.FechaHasta, 
                    r.CantidadPersonas, 
                    mp.Metodo_Pago,
                    er.EstadoReservacion 
                    FROM reservacion AS r INNER JOIN detalle_reserva AS dr ON r.IdReservacion=dr.fk_IdReservacion 
                    INNER JOIN paquetes_turisticos AS p ON p.IdPaquete=dr.fk_IdPaquete INNER JOIN metodo_pago AS mp ON 
                    mp.IdMetodopago=r.fk_IdMetodopago 
                    INNER JOIN estado_reservacion AS er ON er.IdEstadoReservacion=r.fk_IdEstadoReservacion 
                    WHERE r.fk_IdUsuario=2;  ")    
                    // esto del id debe de ser variable, tomado de la sesion del usuario
                    ?>
                    @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{$reserva->IdReservacion}}</td>
                        <td>{{$reserva->Nombre}}</td>
                        <td>{{$reserva->FechaDesde}}</td>
                        <td>{{$reserva->FechaHasta}}</td>
                        <td>{{$reserva->CantidadPersonas}}</td>
                        <td>{{$reserva->Metodo_Pago}}</td>
                        <td>{{$reserva->EstadoReservacion}}</td>
                        <td><button class="btn btn-danger" style="border-radius: 10px;"> <a href="#" style="text-decoration: none; color:black;"></a> Cancelar</button></td>
                    </tr>
                    @endforeach
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </main>

<x-footerusuario></x-footerusuario>