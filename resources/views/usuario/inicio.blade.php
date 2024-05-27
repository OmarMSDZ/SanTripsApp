{{-- header --}}

<x-headusuario></x-headusuario>

<main>
    <article>

        <!--
        - #HERO
      -->

        <section class="hero" id="home">
            <div class="container">

                <h2 class="h1 hero-title">Explora Santiago, Vive la Ciudad</h2>

                <p class="hero-text">
                    Descubre Santiago como nunca antes con SanTrips. Nuestros tours te llevarán a los lugares más
                    fascinantes de la ciudad,
                    creando recuerdos inolvidables en cada paso. ¡Únete a nosotros y vive la experiencia
                </p>

                <div class="btn-group">
                    <button class="btn btn-primary">Leer más</button>

                    <button class="btn btn-secondary"><a href="{{ route('paquetes_turisticos') }}"
                            style="text-decoration: none; color: white;"> Reserva</a></button>
                </div>

            </div>
        </section>

        <section class="tour-search">
            <div class="container">

                <form action="" class="tour-search-form">

                    <div class="input-wrapper">
                        <label for="CategoriaPaquete" class="input-label">Tipo de viaje preferido</label>
                        <select name="CategoriaPaquete" id="" class="form-select input-field">

                            @foreach ($categoriaspaquetes as $categoriapaquete)
                                <option value="{{ $categoriapaquete->id }}">{{ $categoriapaquete->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrapper">
                        <label for="NumPersonas" class="input-label">Numero de Personas</label>

                        <input type="number" name="NumPersonas" id="NumPersonas" required placeholder="N° de personas"
                            class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <label for="FechaDeseada" class="input-label">Fecha deseada</label>

                        <input type="date" name="FechaDeseada" id="FechaDeseada" required class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <label for="Edad" class="input-label">Rango de Edad</label>

                        <select name="Edad" id="" class="form-select input-field">
                            <option value="Todas las Edades">Todas las Edades</option>
                            <option value="Todas las Edades">Niños</option>
                            <option value="Todas las Edades">Adolescentes</option>
                            <option value="Todas las Edades">Solo Adultos</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-secondary">Buscar un Paquete</button>

                </form>

            </div>
        </section>
        <!--
        - #CTA
      -->

        <section class="cta" id="about">
            <div class="container">

                <div class="cta-content">
                    <h4 class="section-subtitle" style="font-size:2.5em;">SanTrips</h4>
                    <hr style="color: white; ">

                    <h2 class="h2 section-title">¿Quiénes Somos?</h2>

                    <p class="text-dark" style="font-size: 1.5em;" data-aos="fade-zoom-in"
                        data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0">
                        Somos una empresa de turismo fundada en el año 2024,
                        la cual se enfoca en brindar sus servicios en la ciudad de Santiago de los Caballeros en la
                        República Dominicana,
                        ofreciendo una gran variedad de tours y experiencias turísticas para el disfrute del público en
                        general.
                    </p>
                </div>

                <style>
                    .gallery {
                        --s: 150px;
                        /* control the size */

                        display: grid;
                        gap: 10px;
                        /* control the gap */
                        grid: auto-flow var(--s)/repeat(3, var(--s));
                        place-items: center;
                        margin: calc(var(--s)/4);
                    }

                    .gallery>img {
                        width: 100%;
                        aspect-ratio: 1;
                        object-fit: cover;
                    }

                    .gallery>img:nth-child(odd) {
                        border-radius: 50%;
                        width: 141%;
                    }

                    .gallery>img:nth-child(even) {
                        --_r: calc(var(--s)/1.414) at;
                        --_g: calc(var(--s)/-2), #000 99%, #0000;
                        --_m:
                            radial-gradient(var(--_r) left 50% bottom var(--_g)),
                            radial-gradient(var(--_r) left 50% top var(--_g)),
                            radial-gradient(var(--_r) top 50% right var(--_g)),
                            radial-gradient(var(--_r) top 50% left var(--_g)),
                            linear-gradient(#000 0 0);
                        -webkit-mask: var(--_m);
                        mask: var(--_m);
                        -webkit-mask-composite: destination-out;
                        mask-composite: exclude;
                    }
                </style>
                <div class="gallery">
                    <img src="{{ asset('img/Centro-Leon.jpg') }}" alt="">
                    <img src="{{ asset('img/estadiocibao.jpg') }}" alt="">
                    <img src="{{ asset('img/carnaval.jpg') }}" alt="">
                    <img src="{{ asset('img/jardin2.jpg') }}" alt="">
                    <img src="{{ asset('img/santigo.jpg') }}" alt="">
                    <img src="{{ asset('img/monumento.jpg') }}" alt="">
                    <img src="{{ asset('img/restaurantes.png') }}" alt="">
                    <img src="{{ asset('img/pico_duarte.jpg') }}" alt="">
                    <img src="{{ asset('img/Catedral.jpg') }}" alt="">
                </div>



            </div>
        </section>

        <section class="book py-5" style="background:var(--bright-navy-blue);  ">

            <div class="container py-lg-5 py-sm-3">
                <h2 class="heading text-capitalize text-center text-light"> ¿Como Funciona?</h2>
                <div class="row mt-5 text-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-map text-light h2"></i>
                            </div>
                            <h4 class="text-light">Elegir Paquete</h4>
                            <p class="mt-3 text-light">Elige de entre una gran variedad de paquetes turisticos el que
                                mas se adapte a tus intereses</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-sm-0 mt-5">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-calendar-event text-light h2"></i>
                            </div>
                            <h4 class="text-light">Reservar y seleccionar Fecha</h4>
                            <p class="mt-3 text-light">Selecciona la fecha que creas mas conveniente para ti, asi como
                                el numero de personas que asistirán y detalles adicionales a tener en cuenta</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-check-circle text-light h2"></i>
                            </div>
                            <h4 class="text-light">Disfrute de su Experiencia</h4>
                            <p class="mt-3 text-light">Al finalizar el proceso de reserva y pago, nuestro equipo le
                                enviará la información para el encuentro presencial en una ubicación conveniente</p>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="color: white;">
                <h2 class="heading text-capitalize text-center text-light">Nuestras Facilidades</h2>
                <div class="row mt-5 text-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-people text-light h2"></i>
                            </div>
                            <h4 class="text-light">Atención al cliente 24/7</h4>
                            <p class="mt-3 text-light">Contamos con un equípo que estará atento a cualquier
                                eventualidad o situación de nuestros clientes, tratando cada caso de manera individual y
                                buscando las mejores soluciones</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-sm-0 mt-5">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-currency-exchange text-light h2"></i>
                            </div>
                            <h4 class="text-light">Ofertas y Descuentos</h4>
                            <p class="mt-3 text-light">Muchos de nuestros paquetes cuentan con ofertas y descuentos de
                                temporada, los cuales hacen que viajar con nosotros sea una opcion económica y accesible
                                para todos</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
                        <div class="grid-info" data-aos="fade-up">
                            <div class="icon">
                                <i class="bi bi-truck-front text-light h2"></i>
                            </div>
                            <h4 class="text-light">Alojamiento y Transporte</h4>
                            <p class="mt-3 text-light">Contamos con diversos proveedores de alojamiento y vehiculos de
                                transporte para facilitar nuestros procesos y brindarte una experiencia agradable</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
  
        <!--
        - #PAQUETES TODO ESTO DEBE ESTAR ASOCIADO A BASE DE DATOS, (traer solo 3 mas recientes)
      -->
        <section class="package" id="package">
            <div class="container">

                <p class="section-subtitle">Paquetes Populares</p>

                <h2 class="h2 section-title">Echa un Vistazo a Nuestros Paquetes</h2>

                <p class="section-text" >
                    Descubre nuestros paquetes más recientes y embárcate en una experiencia de lujo.
                    Desde escapadas románticas hasta emocionantes tours familiares, nuestras ofertas
                    exclusivas están diseñadas para satisfacer todos tus deseos de viaje.
                    ¡Reserva ahora y vive la aventura de tus sueños!
                </p>

                <ul class="package-list">

                    @foreach ($paquetes as $paquete)
                        <li>

                            <div class="package-card" data-aos="fade-up" data-aos-duration="1000">
                                <figure class="card-banner">

                                    <img src="{{ $paquete->imagen1 ? asset('storage/' . $paquete->imagen1) : asset('img/logosantri.jpeg') }}"
                                        alt="" style="width: 20em; height: 15em;">

                                </figure>

                                <div class="card-content">
                                    <h3 class="h3 card-title">{{ $paquete->nombre }}</h3>
                                    <p class="card-text">{{ $paquete->descripcion }}</p>
                                    <ul class="card-meta-list">
                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="time"></ion-icon>
                                                <p class="text">{{ $paquete->tiempoestimado }} H</p>
                                            </div>
                                        </li>
                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="people"></ion-icon>
                                                <p class="text">Max: {{ $paquete->numpersonas }}</p>
                                            </div>
                                        </li>

                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                {{-- <ion-icon name="location"></ion-icon> --}}
                                                <p class="text">Categoría: <br> {{ $paquete->categoria }}</p>
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                                <div class="card-price">
                                    <p class="price">
                                        USD {{ $paquete->costo }}
                                        <span>/ Por Persona</span>
                                    </p>

                                    <form action="{{ route('procesar_reserva') }}" method="POST">
                                        @csrf <!-- Agrega el token CSRF para protección -->
                                        {{-- En esta parte se pasa el id del paquete a la otra vista --}}
                                        <input type="text" name="id" value="{{ $paquete->idpaq }}" hidden>
                                        <button type="submit" class="btn btn-primary mt-3">Reservar ahora</button>
                                    </form>

                                </div>
                            </div>
                        </li>
                    @endforeach


                </ul>
                <!--
AQUI DEBE ENVIAR A LA PAGINA DE PAQUETES PARA RESERVAR -->
                <center>
                    <button class="btn btn-primary"> <a href="{{ route('paquetes_turisticos') }}"
                            style="text-decoration: none; color: white; width: 25rem;"> Descubrir Más </a></button>
                </center>
            </div>
        </section>

    </article>
</main>

<!--
    - #FOOTER
  -->

<x-footerusuario></x-footerusuario>
