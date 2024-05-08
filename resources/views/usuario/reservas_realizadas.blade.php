 

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
            <option value="1">Activas</option>
            <option value="2">Completadas</option>
            <option value="3">Canceladas</option>
        </select>
        <!-- Sección de perfil del usuario -->


        {{-- Esto se debe de hacer con el id del usuario que inicie sesion --}}
        <?php 
           $usuarios = DB::select("SELECT id, name, email FROM users WHERE id=1");
           
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
                        <th>Estado de la Reserva</th>
                        <th>Estado de Pago</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="table-hover">

                    {{-- aqui deberia de traer las reservas realizadas por un usuario especifico --}}
                    <?php 
                    $reservas = DB::select("select * from users where active = ?")    
                    ?>
                    <tr>
                        <td>123456789</td>
                        <td>Paquete 1</td>
                        <td>01/05/2024</td>
                        <td>01/05/2024</td>
                        <td>2</td>
                        <td>Reservado</td>
                        <td>Completo</td>
                        <td><button class="btn btn-danger" style="border-radius: 10px;"> <a href="#" style="text-decoration: none; color:black;"></a> Cancelar</button></td>

                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </main>

<x-footerusuario></x-footerusuario>