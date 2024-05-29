
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>SanTrips Footer</title>
    <style>
        ul {
            margin: 0px;
            padding: 0px;
        }
        .footer-section {
            background: hsl(206, 34%, 20%);
            position: relative;
            color: #fff;
        }
        .footer-cta {
            border-bottom: 1px solid hsl(0, 0%, 60%);
        }
        .single-cta i {
            color: #1ab8f8;
            font-size: 30px;
            float: left;
            margin-top: 8px;
        }
        .cta-text {
            padding-left: 15px;
            display: inline-block;
        }
        .cta-text h4 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .cta-text span {
            color: #b0c4de;
            font-size: 15px;
        }
        .footer-content {
            position: relative;
            z-index: 2;
        }
        .footer-pattern img {
            position: absolute;
            top: 0;
            left: 0;
            height: 330px;
            background-size: cover;
            background-position: 100% 100%;
        }
        .footer-logo {
            margin-bottom: 30px;
        }
        .footer-logo img {
            max-width: 200px;
        }
        .footer-text p {
            margin-bottom: 14px;
            font-size: 14px;
            color: #ffffff;
            line-height: 28px;
        }
        .footer-social-icon {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-social-icon span {
            color: #ffffff;
            display: block;
            font-size: 20px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 20px;
        }
        .footer-social-icon a {
            color: #fff;
            font-size: 16px;
            margin-right: 15px;
        }
        .footer-social-icon i {
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
        }
        .facebook-bg {
            background: #3B5998;
        }
        .twitter-bg {
            background: #55ACEE;
        }
        .instagram-bg {
            background: hsl(214, 72%, 33%);
        }
        .footer-widget-heading h3 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 40px;
            position: relative;
        }
        .footer-widget-heading h3::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -15px;
            height: 2px;
            width: 50px;
            background: #1ab8f8;
        }
        .footer-widget ul li {
            display: inline-block;
            float: left;
            width: 50%;
            margin-bottom: 12px;
        }
        .footer-widget ul li a:hover {
            color: #1ab8f8;
        }
        .footer-widget ul li a {
            color: #b0c4de;
            text-transform: capitalize;
        }
        .subscribe-form {
            position: relative;
            overflow: hidden;
        }
   
        .copyright-area {
            background: #2C4E80;
            padding: 25px 0;
        }
        .copyright-text p {
            margin: 0;
            font-size: 14px;
            color: #b0c4de;
        }
        .copyright-text p a {
            color: #1ab8f8;
        }
        .footer-menu li {
            display: inline-block;
            margin-left: 20px;
        }
        .footer-menu li:hover a {
            color: #1ab8f8;
        }
        .footer-menu li a {
            font-size: 14px;
            color: #b0c4de;
        }
        .footer-widget-heading h3::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -15px;
            height: 2px;
            width: 50px;
            background: #1ab8f8;
        }
    </style>
</head>
<body>
<footer class="footer-section">
    <div class="container">
        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone"></i>
                        <div class="cta-text">
                            <h4>Llámanos</h4>
                            <span><a href="tel:+1 809-471-7827" style="color: #1ab8f8; ">+1 809-471-7827</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open"></i>
                        <div class="cta-text">
                            <h4>Envíanos un correo</h4>
                            <span><a href="mailto:SanTripsRD@gmail.com" style="color: #1ab8f8; ">SanTripsRD@gmail.com</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="cta-text">
                            <h4>¿Tuviste algún problema?</h4>
                            <span><a href="{{route('UserIncidente.index')}}" class="contact-link" style="color: #1ab8f8;">Cuéntanoslo</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html"><img src="{{asset('img/SanTrips (logo azul).svg')}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>¡Estamos aquí para ayudarte! Nuestro equipo está disponible y listo para responder cualquier pregunta que tengas.
                                No dudes en ponerte en contacto con nosotros a través de nuestro correo electrónico, para cualquier consulta o inquietud que puedas tener.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Enlaces útiles</h3>
                        </div>
                        <ul>
                            <li><a href="#">Inicio</a></li>
                            <li><a href="#">Sobre nosotros</a></li>
                            <li><a href="#">Servicios</a></li>
                            <li><a href="#">Portafolio</a></li>
                            <li><a href="#">Contacto</a></li>
                            <li><a href="#">Noticias</a></li>
                            <li><a href="#">Equipo</a></li>
                            <li><a href="#">Contáctanos</a></li>
                            <li><a href="#">Últimas Noticias</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Síguenos</h3>
                        </div>
                        <div class="footer-text mb-25">
                            <p>No te pierdas nuestras actualizaciones, síguenos en nuestras redes sociales.</p>
                        </div>
                        <div class="footer-social-icon">
                            <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                            <a href="https://www.instagram.com/santrips_sti?igsh=MXRoOTBpcTdweDhucg=="><i class="fab fa-instagram instagram-bg"></i></a>
                            <a href="https://x.com/SanTrips121?t=fwkQsSBxOjH536QRkAV-bA&s=09"><i class="fab fa-twitter twitter-bg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Inicio</a></li>
                            <li><a href="#">Términos</a></li>
                            <li><a href="#">Privacidad</a></li>
                            <li><a href="{{route('politicas.index')}}">Política</a></li>
                            <li><a href="#">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                    <div class="copyright-text">
                        <p><span style="border-bottom: 1px solid #1ab8f8;">&nbsp;</span>Copyright &copy; 2024, All Right Reserved <a href="#home">SanTrips</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>



<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
{{-- animaciones --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
  <!-- 
  FLECHA PARA SUBIR
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>