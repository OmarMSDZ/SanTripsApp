<x-headusuario></x-headusuario>

<!-- DATOS PERSONALES -->
<!-- Section: Design Block -->
<section class="mt-5">
    <!-- Jumbotron -->
    {{-- Aqui iria la info del paquete --}}
    @php
        $paquetes = DB::select("SELECT 
    p.id as idpaq, 
    p.Nombre as nombre, 
    p.Descripcion as descripcion,
    p.Costo as costo, 
    p.Num_personas as numpersonas, 
    p.Edades as edades, 
    p.Idiomas as idiomas, 
    p.Alojamiento as alojamiento, 
    p.Tiempo_estimado as tiempoestimado, 
    p.Disponibilidad as disponibilidad, 
    p.Horainicio as horainicio, 
    tip.nombre as categoria, 
    o.Porcentaje as porciento 
FROM 
    paquetes_turisticos as p 
INNER JOIN 
    tipos as tip 
    ON p.fk_IdCategoriaPaq=tip.id 
INNER JOIN 
    ofertas as o 
    ON p.fk_IdOferta=o.IdOferta 
WHERE 
    p.id=$id AND tip.tipo='paquetes';
");
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
                        {{-- incluir esta parte en el controlador mas adelante --}}
                        @php
                            $destinospaquetes = DB::select(
                                "SELECT d.nombre as destino from destinos as d INNER JOIN paquetes_destinos as pd 
                                ON d.id=pd.id_destino WHERE pd.id_paquetes_turistico=?",
                                [$paquete->idpaq],
                            );
                        @endphp



                        <p style="color: hsl(217, 10%, 50.8%)"> Nombre: {{ $paquete->nombre }}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Categoría: {{ $paquete->categoria }}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"> Descripción: {{ $paquete->descripcion }}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-geo-alt-fill"></i> Destinos a Visitar:</p>
                        {{-- Aqui se muestran los destinos de este paquete --}}
                        @foreach ($destinospaquetes as $destinopaquete)
                            <ul class="">
                                <li style="color: hsl(217, 10%, 50.8%)">-{{ $destinopaquete->destino }}</li>
                            </ul>
                        @endforeach
                        <hr>

                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-cash-coin"></i> Costo: {{$paquete->costo}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-people-fill"></i> N° Max. Personas: {{$paquete->numpersonas}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-bar-chart-fill"></i> Edades: {{$paquete->edades}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-translate"></i> Idiomas: {{$paquete->idiomas}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-building-fill"></i> Alojamiento: {{$paquete->alojamiento}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-alarm-fill"></i> Hora de inicio: {{$paquete->horainicio}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-alarm-fill"></i> Duración Estimada (Horas): {{$paquete->tiempoestimado}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-calendar-check-fill"></i> Disponibilidad: {{$paquete->disponibilidad}}</p>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%)"><i class="bi bi-percent"></i> Porcentaje Ofertas (%): {{$paquete->porciento}}</p>

                </div>
                {{-- aqui iria el form de registro --}}
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="{{ route('Reservacion.store') }}" method="POST">
                                @csrf
                                <center><img src="{{ asset('img/SanTrips (logo azul).svg') }}" alt=""
                                        class="form-img" style="width:6em;height:6em;"></center>
                                <center>
                                    <h2>Reserva este Paquete</h2>
                                </center>
                                <hr>

                                <input type="text" name="paquete_id" id="" value="{{ $paquete->idpaq }}"
                                    hidden>
                                <input type="text" name="usuario_id" id="" value="{{ Auth::user()->id }}"
                                    hidden>


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="FechaSeleccionada">Reservar para el
                                                Día:</label>
                                            <input type="date" name="FechaSeleccionada" id=""
                                                class="form-control">
                                            <br>
                                            <label class="form-label" for="DetallesAdicionales">Detalles adicionales (A
                                                tener en cuenta por parte de nuestro equipo)</label>
                                            <textarea name="DetallesAdicionales" id="" cols="30" rows="6" class="form-control"></textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="CantidadPersonasAdultos">Cantidad de
                                                Personas</label>
                                            <hr class="mt-0">



                                            {{-- Mostrar los inputs segun el valor de edades --}}

                                            @if ($paquete->edades == 'TODAS LAS EDADES')
                                                <label class="form-label" for="CantidadPersonasAdultos">Adultos:</label>
                                                <input type="number" id="CantidadPersonasAdultos"
                                                    name="CantidadPersonasAdultos" class="form-control" min="1">
                                                <label class="form-label"
                                                    for="CantidadPersonasAdolescentes">Adolescentes:</label>
                                                <input type="number" id="CantidadPersonasAdolescentes"
                                                    name="CantidadPersonasAdolescentes" class="form-control">
                                                <label class="form-label" for="CantidadPersonasNinos">Niños:</label>
                                                <input type="number" id="CantidadPersonasNinos"
                                                    name="CantidadPersonasNinos" class="form-control">
                                            @elseif ($paquete->edades == 'ADOLESCENTES Y ADULTOS')
                                                <label class="form-label"
                                                    for="CantidadPersonasAdolescentes">Adolescentes:</label>
                                                <input type="number" id="CantidadPersonasAdolescentes"
                                                    name="CantidadPersonasAdolescentes" class="form-control">
                                                <label class="form-label" for="CantidadPersonasAdultos">Adultos:</label>
                                                <input type="number" id="CantidadPersonasAdultos"
                                                    name="CantidadPersonasAdultos" class="form-control" min="1">
                                            @elseif ($paquete->edades == 'SOLO ADULTOS')
                                                <label class="form-label" for="CantidadPersonasAdultos">Adultos:</label>
                                                <input type="number" id="CantidadPersonasAdultos"
                                                    name="CantidadPersonasAdultos" class="form-control" min="1">
                                            @endif
                                            {{-- para actualizar dinamicamente el precio, numero de personas y descuentos aplicados --}}
                                            <script>
                                                document.addEventListener('DOMContentLoaded', (event) => {
                                                    const adultosInput = document.getElementById('CantidadPersonasAdultos');
                                                    const adolescentesInput = document.getElementById('CantidadPersonasAdolescentes');
                                                    const ninosInput = document.getElementById('CantidadPersonasNinos');
                                                    const totalInput = document.getElementById('CantidadPersonas');
                                                    const costoPorPersonaInput = document.getElementById('CostoPorPersona');
                                                    const porcentajeInput = document.getElementById('Porcentaje');
                                                    const costoTotalInput = document.getElementById('MontoTotal');

                                                    function updateTotal() {
                                                        const adultos = parseInt(adultosInput?.value) || 0;
                                                        const adolescentes = parseInt(adolescentesInput?.value) || 0;
                                                        const ninos = parseInt(ninosInput?.value) || 0;
                                                        const total = adultos + adolescentes + ninos;
                                                        totalInput.value = total;

                                                        const costoPorPersona = parseFloat(costoPorPersonaInput.value) || 0;
                                                        const porcentaje = parseFloat(porcentajeInput.value) || 0;
                                                        const costoTotal = (total * costoPorPersona) * (1 - (porcentaje / 100));
                                                        costoTotalInput.value = costoTotal.toFixed(2);

                                                        console.log('Total personas:', total);
                                                        console.log('Costo por persona:', costoPorPersona);
                                                        console.log('Porcentaje de descuento:', porcentaje);
                                                        console.log('Costo total calculado:', costoTotal);
                                                        console.log('Costo total input value:', costoTotalInput.value);
                                                    }

                                                    if (adultosInput) adultosInput.addEventListener('input', updateTotal);
                                                    if (adolescentesInput) adolescentesInput.addEventListener('input', updateTotal);
                                                    if (ninosInput) ninosInput.addEventListener('input', updateTotal);
                                                    costoPorPersonaInput.addEventListener('input', updateTotal);
                                                    porcentajeInput.addEventListener('input', updateTotal);

                                                    // Initialize total cost on page load
                                                    updateTotal();
                                                });
                                            </script>




                                            <center>
                                                <label for="CantidadPersonas">Cantidad Total Personas:</label>
                                                <input type="number" id="CantidadPersonas" name="CantidadPersonas"
                                                    class="form-control" min="1"
                                                    max="{{ $paquete->numpersonas }}" readonly>
                                            </center>

                                            {{-- para sumar los valores de los input --}}


                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6 mb-4">


                                        <div data-mdb-input-init class="form-outline">
                                            <input type="number" id="CostoPorPersona" hidden readonly
                                                value="{{ $paquete->costo }}">
                                            <input type="number" id="Porcentaje" value="{{ $paquete->porciento }}"
                                                hidden readonly>

                                            <label for="MontoTotal">Monto Total a Pagar (RD$) </label>

                                            {{-- <input type="number" name="MontoTotal" class="form-control" readonly step="0.01" value="{{($paquete->costo)-((($paquete->costo)*($paquete->porciento))/100)}}"> --}}
                                            <input type="number" id="MontoTotal" name="MontoTotal"
                                                class="form-control" readonly step="0.01" value="">
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-6 mb-4">

                                        {{-- En este caso, al darle a submit, deberia enviarnos al form de pago con la forma correspondiente --}}
                                        @php
                                            $metodospago = DB::select(
                                                'SELECT IdMetodoPago as id, Metodo_Pago as metodo FROM metodo_pago;',
                                            );
                                        @endphp
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="MetodoPago">Método de Pago</label>
                                            <select name="MetodoPago" id="" class="form-select">
                                                @foreach ($metodospago as $mp)
                                                    <option value="{{ $mp->id }}">{{ $mp->metodo }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                    </div>
                                </div>
                                <!-- Submit button -->
                                <center>
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-block mb-4">Reservar</button>
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
<!-- 
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
</form> --}} -->




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
