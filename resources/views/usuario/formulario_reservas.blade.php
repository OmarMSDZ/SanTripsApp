<x-headusuario></x-headusuario>

<!-- DATOS PERSONALES -->
{{-- <h1>Reservacion de paquetes</h1>
<form class="formulario" action="insertar.php" method="POST">
    <p>El ID del paquete es</p>
    <input type="text" name="id" value="{{ $id }}">
    <h2>Datos personales</h2>
    <label for="nombre">Nombres:</label>
    <input type="text" name="nombre" id="nombre">
    <label for="apellido">Apellidos:</label>
    <input type="text" name="apellido" id="apellido">
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono">
    <label for="cedula">Cédula:</label>
    <input type="text" name="cedula" id="cedula">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <label for="cantidad_adultos">Cantidad de adultos:</label>
    <input type="number" name="cantidad_adultos" id="cantidad_adultos" min="0" value="1">
    <label for="cantidad_ninos">Cantidad de niños:</label>
    <input type="number" name="cantidad_ninos" id="cantidad_ninos" min="0" value="1">
    <h2>Detalles del paquete turístico</h2>
    <p>Seleccione el paquete turístico:</p>
    <select name="paquete_turistico">
        <option value="paquete1">Paquete 1</option>
        <option value="paquete2">Paquete 2</option>
        <option value="paquete3">Paquete 3</option>
    </select>
    <label for="fecha_desde">Desde:</label>
    <input type="date" id="fecha_desde" name="fecha_desde">
    <label for="fecha_hasta">Hasta:</label>
    <input type="date" id="fecha_hasta" name="fecha_hasta">
    <label for="detalles">Detalles adicionales:</label><br>
    <textarea id="detalles" name="detalles" rows="4" cols="50"></textarea>
    <br><br>
    <br>

    <!-- no tocar lo que tiene en el medio -->
    <input type="reset" value="Borrar Campos">&nbsp;&nbsp;&nbsp;<input type="submit" value="Reservar">
</form> --}}



      <!-- Section: Design Block -->
      <section class="mt-5">
        <!-- Jumbotron -->
        {{-- Aqui iria la info del paquete --}}
        @php
             $paquetes = DB::select("SELECT p.id as idpaq, p.Nombre as nombre, p.Descripcion as descripcion,
         p.Costo as costo, p.Num_personas as numpersonas, p.Edades as edades, p.Idiomas as idiomas, p.Alojamiento as alojamiento, p.Tiempo_estimado as tiempoestimado, 
        p.Disponibilidad as disponibilidad, c.CategoriaPaq as categoria, o.Porcentaje as porciento FROM
          paquetes_turisticos as p INNER JOIN categorias_paquetes as c ON p.fk_IdCategoriaPaq=c.IdCategoriaPaq 
          INNER JOIN ofertas as o ON p.fk_IdOferta=o.IdOferta WHERE p.id=$id");
        @endphp

        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h2 class="my-5 display-3 fw-bold ls-tight">
                            Información del Paquete <br />
                            {{-- <span class="text-primary">for your business</span> --}}
                        </h2>
                            @foreach ($paquetes as $paquete)
                                
                            
                        
                        <p style="color: hsl(217, 10%, 50.8%)"> Nombre: {{$paquete->nombre}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Categoría: {{$paquete->categoria}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Descripción: {{$paquete->descripcion}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Costo: {{$paquete->costo}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> N° Max. Personas: {{$paquete->numpersonas}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Edades: {{$paquete->edades}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Idiomas: {{$paquete->idiomas}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Alojamiento: {{$paquete->alojamiento}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Duración Estimada (Horas): {{$paquete->tiempoestimado}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Disponibilidad: {{$paquete->disponibilidad}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Porcentaje Ofertas (%): {{$paquete->porciento}}</p>
                       
                    </div>
                    {{-- aqui iria el form de registro --}}
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form action="{{route('Reservacion.store')}}" method="POST">
                                    @csrf
                                   <center><img src="{{asset('img/SanTrips (logo azul).svg')}}" alt="" class="form-img" style="width:6em;heigth:6em;"></center>
                                    <center> <h2>Reserva este Paquete</h2> </center>
                                    <hr>

                                   <input type="text" name="paquete_id" id="" value="{{$paquete->idpaq}}" hidden>
                                   <input type="text" name="usuario_id" id="" value="{{Auth::user()->id}}" hidden>
                                    
                                   
                                   <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <label class="form-label" for="FechaSeleccionada">Reservar para el Día:</label>
                                                <input type="date" name="FechaSeleccionada" id="" class="form-control">
                                                <br>
                                                <label class="form-label" for="DetallesAdicionales">Detalles adicionales (A tener en cuenta por parte de nuestro equipo)</label>
                                                <textarea name="DetallesAdicionales" id="" cols="30" rows="6" class="form-control"></textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <label class="form-label" for="CantidadPersonasAdultos">Cantidad de Personas</label>
                                                {{-- Estos campos deben de sumarse y presentarse en la parte de CantidadPersonas --}}
                                                <hr class="mt-0">
                                      
                                                <label class="form-label" for="CantidadPersonasAdultos">Adultos:</label>
                                                <input type="number" name="CantidadPersonasAdultos" class="form-control">
                                            
                                                <label class="form-label" for="CantidadPersonasAdolescentes">Adolescentes:</label>
                                                <input type="number" name="CantidadPersonasAdolescentes" class="form-control">
                                        
                                                <label class="form-label" for="CantidadPersonasNinos">Niños:</label>
                                                <input type="number" name="CantidadPersonasNinos" class="form-control">
                                      
                                                <center>
                                                <label for="CantidadPersonas">Cantidad Total Personas:</label>
                                                <input type="number" name="CantidadPersonas" class="form-control" min="1" max="{{$paquete->numpersonas}}">
                                                </center>
                                              
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                    <div class="col-md-6 mb-4">
                                        
                                         
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="MontoTotal">Monto Total a Pagar (RD$) </label>
                                            {{-- Con esto se calcula el monto total aplicandole el descuento --}}
                                            <input type="number" name="MontoTotal" class="form-control" readonly step="0.01" value="{{($paquete->costo)-((($paquete->costo)*($paquete->porciento))/100)}}">
                                        </div>

                                        @endforeach
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        
                                        {{-- En este caso, al darle a submit, deberia enviarnos al form de pago con la forma correspondiente --}}
                                        @php
                                            $metodospago = DB::select('SELECT IdMetodoPago as id, Metodo_Pago as metodo FROM metodo_pago;');
                                        @endphp
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="MetodoPago">Método de Pago</label>
                                            <select name="MetodoPago" id="" class="form-select">
                                                @foreach ($metodospago as $mp)
                                                    <option value="{{$mp->id}}">{{$mp->metodo}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        

                                    </div>
                                </div>
                                    <!-- Submit button -->
                                    <center>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Reservar</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->


<!-- FORMULARIO DE PAGO -->

{{-- 
<form class="formulario" action="procesar_pago_paypal.php" method="POST">
    <h2>Formulario de Pago PayPal</h2>
    <div class="form-group">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad">
        <label for="codigo_postal">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal">
        <label for="pais">País:</label>
        <select id="pais" name="pais" required>
            <option value="">Seleccionar país</option>
            <option value="US">Estados Unidos</option>
            <option value="CA">Canadá</option>
            <option value="MX">México</option>
            <!-- Agrega más opciones según tus necesidades -->
        </select>
        <label for="monto">Monto a Pagar:</label>
        <input type="number" id="monto" name="monto" min="0.01" step="0.01" required>
        <label for="descripcion">Descripción del Pago:</label>
        <textarea id="descripcion" name="descripcion" rows="4"></textarea>
        <input type="submit" value="Pagar con PayPal">
    </div>
</form> --}}




<!-- <script>
    // Obtener el textarea
    var textarea = document.getElementById('otros_datos');

    // Remover el texto de introducción cuando se hace clic en el textarea
    textarea.addEventListener('focus', function() {
        if (textarea.value === 'Introduzca aquí otros datos de interés.') {
            textarea.value = '';
        }
    });

    // Restaurar el texto de introducción si el textarea está vacío al perder el foco
    textarea.addEventListener('blur', function() {
        if (textarea.value === '') {
            textarea.value = 'Introduzca aquí otros datos de interés.';
        }
    });
</script> -->

<x-footerusuario></x-footerusuario>
