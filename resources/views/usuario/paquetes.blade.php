<x-headusuario></x-headusuario>
 

<style>
    .contenido {
        margin-top: 10em;
        margin-bottom: 10em;
    }

    .user-profile img {
        width: 124px;
        height: 124px;
    }

    .card-body img {
        size: auto;
    }
</style>

<main class="container contenido">
 
     <center> <h1>Paquetes Turísticos</h1> </center>
    <hr>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        {{-- Consulta para obtener la info de los paquetes --}}
        {{-- @php
            
        $paquetes = DB::select("SELECT p.id as idpaq, p.Nombre as nombre, p.Descripcion as descripcion,
        p.Costo as costo, p.Num_personas as numpersonas, p.Edades as edades, p.Idiomas as idiomas, p.Alojamiento as alojamiento, p.Tiempo_estimado as tiempoestimado, 
        p.Disponibilidad as disponibilidad, c.nombre as categoria, o.Porcentaje as porciento, p.imagen1 as imagen1 FROM
        paquetes_turisticos as p INNER JOIN tipos as c ON p.fk_IdCategoriaPaq=c.id INNER JOIN ofertas as o ON p.fk_IdOferta=o.IdOferta where c.tipo='paquetes'");
        
        @endphp --}}

        {{-- De esta forma se imprime cada paquete en la pagina luego de hacer la consulta --}}
        @foreach($paquetes as $paquete)

        <div class="col">
            <div class="card h-100">
                <div class="card-body"> 
 
                    {{-- <img src="{{asset('img/logosantri.jpeg')}}" alt="" class="card-img-top"> --}}

                    {{-- imagen del paquete, muestra la primera imagen--}}
                    <img src="{{ $paquete->imagen1 ? asset('storage/' . $paquete->imagen1) : asset('img/logosantri.jpeg') }}" alt="" class="card-img-top" style="width:21em; height:21em;">

                    <hr>
                    <h3 class="card-title">{{$paquete->nombre}}</h3>
                    <p class="card-text"> <span style="font-weight:bold">Categoría:</span> {{$paquete->categoria}}</p>
                
                    <button class="btn btn-primary" onclick="toggleMoreInfo(this)">Mostrar Más Información</button>
                    <div class="more-info d-none">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Descripción: {{$paquete->descripcion}}</li>
                            @php
                            $destinospaquetes = DB::select("SELECT d.nombre as destino from destinos as d INNER JOIN paquetes_destinos as pd 
                            ON d.id=pd.id_destino WHERE pd.id_paquetes_turistico=?", [$paquete->idpaq]);
                            @endphp
                            <li class="list-group-item"><i class="bi bi-geo-alt-fill"></i> Destinos a Visitar:
                                @foreach ($destinospaquetes as $destinopaquete)
                                    <ul class="">
                                        <li class="">-{{$destinopaquete->destino}}</li>
                                    </ul>
                                @endforeach

                            </li>
                            <li class="list-group-item"><i class="bi bi-people-fill"></i> N° Max. Personas: {{$paquete->numpersonas}}</li>
                            <li class="list-group-item"><i class="bi bi-bar-chart-fill"></i> Edades: {{$paquete->edades}}</li>
                            <li class="list-group-item"><i class="bi bi-translate"></i> Idiomas: {{$paquete->idiomas}}</li>
                            <li class="list-group-item"><i class="bi bi-building-fill"></i> Disponibilidad Alojamiento: {{$paquete->alojamiento}}</li>
                            <li class="list-group-item"><i class="bi bi-alarm-fill"></i> Duración Estimada (En Horas): {{$paquete->tiempoestimado}}</li>
                            <li class="list-group-item"><i class="bi bi-calendar-check-fill"></i> Disponibilidad: {{$paquete->disponibilidad}}</li>
                            <li class="list-group-item"><i class="bi bi-cash-coin"></i> Costo por persona (USD): {{$paquete->costo}}</li>
                        </ul>
                        <form action="{{ route('procesar_reserva')}}" method="POST">
                            @csrf <!-- Agrega el token CSRF para protección -->
                            {{-- En esta parte se pasa el id del paquete a la otra vista --}}
                            <input type="text" name="id" value="{{$paquete->idpaq}}" hidden>
                            <button type="submit" class="btn btn-primary mt-3">Reservar</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> 

        @endforeach
    <!-- Aquí irían las otras tarjetas de los paquetes turísticos, siguiendo el mismo patrón, se generarían automaticamente desde la BD -->
     </div>
 

 

     
</main>

<script>
    //para el boton de mostrar mas informacion 
    function toggleMoreInfo(button) {
        const moreInfo = button.nextElementSibling;
        moreInfo.classList.toggle('d-none');
        button.textContent = moreInfo.classList.contains('d-none') ? 'Mostrar Más Información' : 'Ocultar';
    }
</script>

<x-footerusuario></x-footerusuario>
