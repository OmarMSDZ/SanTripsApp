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

                    <button class="btn btn-secondary"><a href="{{route('paquetes_turisticos')}}" style="text-decoration: none; color: white;"> Reserva</a></button>
                </div>

            </div>
        </section>
 

  <!--
        - #TOUR SEARCH
      -->

      <section class="tour-search">
        <div class="container">

            <form action="" class="tour-search-form">

                <div class="input-wrapper">
                    <label for="CategoriaPaquete" class="input-label">Tipo de viaje preferido</label>
                    <select name="CategoriaPaquete" id="" class="form-select input-field">
                       
                        @foreach ($categoriaspaquetes as $categoriapaquete)
                        <option value="{{$categoriapaquete->id}}">{{$categoriapaquete->nombre}}</option>
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

      <section class="cta" id="">
        <div class="container"> 

            <div class="cta-content">
               <h4 class="section-subtitle" style="font-size:2.5em;">SanTrips</h4>
               <hr style="color: white; ">

                <h2 class="h2 section-title">¿Quiénes Somos?</h2>

                <p class="text-dark" style="font-size: 1.5em;">
                    Somos una empresa de turismo fundada en el año 2024, 
                    la cual se enfoca en brindar sus servicios en la ciudad de Santiago de los Caballeros en la República Dominicana, 
                    ofreciendo una gran variedad de tours y experiencias turísticas para el disfrute del público en general.
                </p>
            </div> 

            

            <style>
                .gallery {
                    --s: 150px; /* control the size */
                    
                    display: grid;
                    gap: 10px; /* control the gap */
                    grid: auto-flow var(--s)/repeat(3,var(--s));
                    place-items: center;
                    margin: calc(var(--s)/4);
                }
                .gallery > img {
                    width: 100%;
                    aspect-ratio: 1;
                    object-fit: cover;
                }
                .gallery > img:nth-child(odd) {
                    border-radius: 50%;
                    width: 141%;
                }
                .gallery > img:nth-child(even) {
                    --_r: calc(var(--s)/1.414) at;
                    --_g: calc(var(--s)/-2),#000 99%,#0000;
                    --_m:
                        radial-gradient(var(--_r) left 50% bottom var(--_g)),
                        radial-gradient(var(--_r) left 50% top    var(--_g)),
                        radial-gradient(var(--_r) top  50% right  var(--_g)),
                        radial-gradient(var(--_r) top  50% left   var(--_g)),
                        linear-gradient(#000 0 0);
                    -webkit-mask: var(--_m);
                            mask: var(--_m);
                    -webkit-mask-composite: destination-out;
                            mask-composite: exclude;
                }
            </style>
            <div class="gallery">
                <img src="{{asset('img/Centro-Leon.jpg')}}" alt="">
                <img src="{{asset('img/estadiocibao.jpg')}}" alt="">
                <img src="{{asset('img/carnaval.jpg')}}" alt="">
                <img src="{{asset('img/jardin2.jpg')}}" alt="">
                <img src="{{asset('img/santigo.jpg')}}" alt="">
                <img src="{{asset('img/monumento.jpg')}}" alt="">
                <img src="{{asset('img/restaurantes.png')}}" alt="">
                <img src="{{asset('img/pico_duarte.jpg')}}" alt="">
                <img src="{{asset('img/Catedral.jpg')}}" alt="">
              </div>



        </div> 
    </section>


    
        <!--
        - #POPULAR
      -->
{{-- 
        <section class="popular" id="destination">
            <div class="container">

                <p class="section-subtitle">Descubre lugares</p>

                <h2 class="h2 section-title">Destinos populares</h2>

                <p class="section-text">

                    Descubre destinos que te transportarán a mundos de ensueño.
                    Explora, sueña, y haz de cada viaje una experiencia inolvidable..
                </p>

                <ul class="popular-list">

                    <li>
                        <div class="popular-card">

                            <figure class="card-img">
                                <img src="{{ asset('img/monumento.jpg') }}" alt="Monumento de Santiago">

                            </figure>

                            <div class="card-content">

                        

                                <p class="card-subtitle">
                                    <a href="#">Santiago</a>
                                </p>

                                <h3 class="h3 card-title">
                                    <a href="#">Monumento de los héroes</a>
                                </h3>

                                <p class="card-text">
                                    Tributo a la valentía dominicana. Vistas panorámicas, historia viva y emociones
                                    únicas te aguardan.
                                </p>

                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="popular-card">

                            <figure class="card-img">
                                <img src="{{ asset('img/jardin2.jpg') }}" alt="Jardin Botanico">
                            </figure>

                            <div class="card-content">

                       

                                <p class="card-subtitle">
                                    <a href="#">Santiago</a>
                                </p>

                                <h3 class="h3 card-title">
                                    <a href="#">Jardin Botanico</a>
                                </h3>

                                <p class="card-text">

                                    Un escape sereno en el corazón de la ciudad, donde la belleza de la flora local te
                                    sorprenderá en cada paso.
                                </p>

                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="popular-card">

                            <figure class="card-img">
                                <img src="{{ asset('img/Catedral.jpg') }}" alt="Catedral de santiago apostol">

                            </figure>

                            <div class="card-content">

                       

                                <p class="card-subtitle">
                                    <a href="#">Santiago</a>
                                </p>

                                <h3 class="h3 card-title">
                                    <a href="#">Catedral de Santiago Apostol</a>
                                </h3>

                                <p class="card-text">
                                    Testigo de siglos de historia y devoción,te invita a sumergirte en su esplendor
                                    arquitectónico y espiritual
                                </p>

                            </div>

                        </div>
                    </li>

                </ul>
                <center>
                    <button class="btn btn-primary">Descubre Más Destinos</button>
                </center>
            </div>
        </section> --}}

        <!--
        - #PAQUETES TODO ESTO DEBE ESTAR ASOCIADO A BASE DE DATOS, (traer solo 3 mas recientes)
      -->
        <section class="package" id="package">
            <div class="container">

                <p class="section-subtitle">Paquetes Populares</p>

                <h2 class="h2 section-title">Echa un Vistazo a Nuestros Paquetes</h2>

                <p class="section-text">
                    Descubre nuestros paquetes más recientes y embárcate en una experiencia de lujo. 
                    Desde escapadas románticas hasta emocionantes tours familiares, nuestras ofertas 
                    exclusivas están diseñadas para satisfacer todos tus deseos de viaje. 
                    ¡Reserva ahora y vive la aventura de tus sueños!
                </p>

                <ul class="package-list">

                    @foreach ($paquetes as $paquete)
                        
                   

                    <li>
                         
                        <div class="package-card">
                            <figure class="card-banner">
                     
                                <img src="{{ $paquete->imagen1 ? asset('storage/' . $paquete->imagen1) : asset('img/logosantri.jpeg') }}" alt="" style="width: 20em; height: 15em;" >

                            </figure>

                            <div class="card-content">
                                <h3 class="h3 card-title">{{$paquete->nombre}}</h3>
                                <p class="card-text">{{$paquete->descripcion}}</p>
                                <ul class="card-meta-list">
                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="time"></ion-icon>
                                            <p class="text">{{$paquete->tiempoestimado}} H</p>
                                        </div>
                                    </li>
                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="people"></ion-icon>
                                            <p class="text">Max: {{$paquete->numpersonas}}</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            {{-- <ion-icon name="location"></ion-icon> --}}
                                            <p class="text">Categoría: <br> {{$paquete->categoria}}</p>
                                        </div>
                                    </li>
                                    

                                </ul>
                            </div>
                            <div class="card-price">
                                <p class="price">
                                    RD$ {{$paquete->costo}}
                                    <span>/ Por Persona</span>
                                </p>
                        
                                        <form action="{{ route('procesar_reserva')}}" method="POST">
                                        s

                            </div>
                        </div>
                    </li>
                    @endforeach


                </ul>
                <!--
AQUI DEBE MANDAR A LA PAGINA DE PAQUETES PARA RESERVAR -->
                <center>
                <button class="btn btn-primary"> <a href="{{route('paquetes_turisticos')}}" style="text-decoration: none; color: white; width: 25rem;">   Descubrir Más </a></button>
                </center>
            </div>
        </section>











       

    </article>
</main>

<!--
    - #FOOTER
  -->

<x-footerusuario></x-footerusuario>
