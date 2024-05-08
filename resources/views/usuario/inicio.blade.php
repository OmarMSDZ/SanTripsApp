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
                        <label for="destination" class="input-label">Buscar destino*</label>

                        <input type="text" name="destination" id="destination" required
                            placeholder="ingresar destino" class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <label for="people" class="input-label">Num peronas*</label>

                        <input type="number" name="people" id="people" required placeholder="No.de personas"
                            class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <label for="checkin" class="input-label">Checkin Date**</label>

                        <input type="date" name="checkin" id="checkin" required class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <label for="checkout" class="input-label">Checkout Date*</label>

                        <input type="date" name="checkout" id="checkout" required class="input-field">
                    </div>

                    <button type="submit" class="btn btn-secondary">Adquiere ahora</button>

                </form>

            </div>
        </section>





        <!--
        - #POPULAR
      -->

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
        </section>

        <!--
        - #PAQUETES TODO ESTO DEBE ESTAR ASOCIADO A BASE DE DATOS, (traer solo 3)
      -->
        <section class="package" id="package">
            <div class="container">

                <p class="section-subtitle">Paquetes Populares</p>

                <h2 class="h2 section-title">Echa un Vistazo a Nuestros Paquetes</h2>

                <p class="section-text">
                    Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque
                    laudantium.
                    Sit ornare
                    mollitia tenetur, aptent.
                </p>

                <ul class="package-list">

                    <li>
                        <div class="package-card">

                            <figure class="card-banner">
                                <img src="{{ asset('img/pico_duarte.jpg') }}" alt="Pico Duarte">

                            </figure>

                            <div class="card-content">

                                <h3 class="h3 card-title">Pico Duarte</h3>

                                <p class="card-text">
                                    Laoreet, voluptatum nihil dolor esse quaerat mattis explicabo maiores, est aliquet
                                    porttitor! Eaque,
                                    cras, aspernatur.
                                </p>

                                <ul class="card-meta-list">

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="time"></ion-icon>

                                            <p class="text">48H</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="people"></ion-icon>

                                            <p class="text">Max: 5</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="location"></ion-icon>

                                            <p class="text">República Dominicana, <br> Santiago de los Caballeros</p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-price">
                                <p class="price">
                                    $1000
                                    <span>/ Por Persona</span>
                                </p>
                                <button class="btn btn-secondary"> <a href=""
                                        style="text-decoration: none; color: white;">Reserva ahora</a></button>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="package-card">

                            <figure class="card-banner">
                                <img src="{{ asset('img/Centro-Leon.jpg') }}" alt="Centro Leon">

                            </figure>

                            <div class="card-content">

                                <h3 class="h3 card-title">Summer Holiday To The Oxolotan River</h3>

                                <p class="card-text">
                                    Laoreet, voluptatum nihil dolor esse quaerat mattis explicabo maiores, est aliquet
                                    porttitor! Eaque,
                                    cras, aspernatur.
                                </p>

                                <ul class="card-meta-list">

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="time"></ion-icon>

                                            <p class="text">7D/6N</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="people"></ion-icon>

                                            <p class="text">pax: 10</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="location"></ion-icon>

                                            <p class="text">Malaysia</p>
                                        </div>
                                    </li>

                                </ul>

                            </div>

                            <div class="card-price">

                                <div class="wrapper">

                                    <p class="reviews">(20 reviews)</p>

                                    <div class="card-rating">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                    </div>

                                </div>

                                <p class="price">
                                    $520
                                    <span>/ per person</span>
                                </p>

                                <button class="btn btn-secondary">Book Now</button>

                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="package-card">

                            <figure class="card-banner">
                                <img src="{{ asset('img/estadiocibao.jpg') }}" alt="Estadio Cibao">

                            </figure>

                            <div class="card-content">

                                <h3 class="h3 card-title">Santorini Island's Weekend Vacation</h3>

                                <p class="card-text">
                                    Laoreet, voluptatum nihil dolor esse quaerat mattis explicabo maiores, est aliquet
                                    porttitor! Eaque,
                                    cras, aspernatur.
                                </p>

                                <ul class="card-meta-list">

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="time"></ion-icon>

                                            <p class="text">7D/6N</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="people"></ion-icon>

                                            <p class="text">pax: 10</p>
                                        </div>
                                    </li>

                                    <li class="card-meta-item">
                                        <div class="meta-box">
                                            <ion-icon name="location"></ion-icon>

                                            <p class="text">Malaysia</p>
                                        </div>
                                    </li>

                                </ul>

                            </div>

                            <div class="card-price">

                                <div class="wrapper">

                                    <p class="reviews">(40 reviews)</p>

                                    <div class="card-rating">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                    </div>

                                </div>

                                <p class="price">
                                    $660
                                    <span>/ per person</span>
                                </p>

                                <button class="btn btn-secondary">Book Now</button>

                            </div>

                        </div>
                    </li>

                </ul>
                <!--
AQUI DEBE MANDAR A LA PAGINA DE PAQUETES PARA RESERVAR -->

                <button class="btn btn-primary"> <a href="{{route('paquetes_turisticos')}}" style="text-decoration: none; color: white;">   Descubrir Más </a></button>

            </div>
        </section>











        <!--
        - #CTA
      -->

        <section class="cta" id="contact">
            <div class="container">

                <div class="cta-content">
                    <p class="section-subtitle">Call To Action</p>

                    <h2 class="h2 section-title">LISTO PARA VIAJES INOLVIDABLES?</h2>

                    <p class="section-text">
                        Estamos disponibles para acompañarte en tu próxima aventura. Puedes contactarnos para cualquier
                        pregunta que tengas.
                        ¡Esperamos ser parte de tu experiencia y ayudarte en todo lo que necesites!
                    </p>
                </div>

                <!-- QUE ENVIE A ALGUN LUGAR DE CONTACTO -->
                <button class="btn btn-secondary">Contáctanos!</button>

            </div>
        </section>

    </article>
</main>

<!--
    - #FOOTER
  -->

<x-footerusuario></x-footerusuario>
