 

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
            <option value="ACTIVA">Activas</option>
            <option value="EN PROCESO">En Proceso</option>
            <option value="CANCELADA">Canceladas</option>
            <option value="COMPLETADA">Completada</option>
        </select>
        <hr>
        <!-- Sección de perfil del usuario -->


        {{-- Esto se debe de hacer con el id del usuario que inicie sesion --}}
        {{-- @php
             
        //     $idusuario = Auth::user()->id;

        //    $usuarios = DB::select("SELECT id, name, email FROM users WHERE id=$idusuario");
           
        
        @endphp --}}
        @foreach ($usuarios as $usuario)
            
        
        <div class="user-profile">
            {{-- <img src="{{asset('img/favicon.png')}}" alt="Foto de perfil" > --}}
            <div class="user-info">
                <h2>Información del Usuario</h2>
                <p hidden>{{$usuario->id}}</p>
                <p> <span style="font-weight:bold;"> Nombre: </span> {{$usuario->name}}</p>
                <p> <span style="font-weight:bold;"> Email: </span> {{$usuario->email}}</p>
                <!-- Agrega más información del perfil según sea necesario -->
                @endforeach    
            </div>
        </div>
    

        <hr>

        
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
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        
            <div class="table-container">
            
                <table class="table table-responsive" style="overflow: auto; position: sticky;">

                <thead>
                    <tr> 
                        <th>No.Reserva</th>
                        <th>Nombre del Paquete</th>
                        <th>Fecha Seleccionada</th>
              
                        <th>N° Personas</th>
                        <th>Metodo de Pago</th>
                        <th>Estado de la Reserva</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="table-hover">

                    

                    @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{$reserva->IdReservacion}}</td>
                        <td>{{$reserva->Nombre}}</td>
                        <td>{{$reserva->FechaSeleccionada}}</td>
                  
                        <td>{{$reserva->CantidadPersonas}}</td>
                        <td>{{$reserva->Metodo_Pago}}</td>
                        <td>{{$reserva->EstadoReservacion}}</td>
                        
                        <td>
                            <form action="{{ route('cancelarReservacion') }}" method="POST">

                                @csrf <!-- Token CSRF para protección -->
                                <input type="hidden" name="id_reserva" value="{{ $reserva->IdReservacion }}" readonly>
                                <input type="date" name="fecha_reserva" value="{{$reserva->FechaSeleccionada}}" hidden readonly>
                                <button type="submit" class="btn btn-danger mt-3">Cancelar</button>
                            </form>
                    </td>
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