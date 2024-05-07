<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reservas.css">
    <link rel="icon" type="image/jpg" href="img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Mis Reservas</title>
</head>
<body>

    <nav class="nav">
        <div class="nav-logo">
            <p>SanTrips</p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="/Principal.html" class="link active">Home</a></li>
                <li><a href="#" class="link">Blog</a></li>
                <li><a href="#" class="link">Services</a></li>
                <li><a href="#" class="link">About</a></li>
            </ul>
        </div>
       
        
       
    </nav>
   
      <br><br><br><br><br><br>

        <div class="container">
            <h1>Mis Reservas</h1>

        <!-- Sección de perfil del usuario -->
        <div class="user-profile">
            <img src="img/favicon.png" alt="Foto de perfil">
            <div class="user-info">
                <h2>Usuario</h2>
                <p>Nombre: Herlyn</p>
                <p>Email: 2200011@ipisa.edu.do</p>
                <!-- Agrega más información del perfil según sea necesario -->
            </div>
        </div>
    
            <table>
                <thead>
                    <tr> 
                        <th>No.Reserva</th>
                        <th>Nombre del Paquete</th>
                        <th>Fecha Inicio Reserva</th>
                        <th>Fecha Fin Reserva</th>
                        <th>Estado de la Reserva</th>
                        <th>Estado de Pago</th>
                        <th>Cancelar Reserva</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123456789</td>
                        <td>Paquete 1</td>
                        <td>01/05/2024</td>
                        <td>01/05/2024</td>
                        <td>Reservado</td>
                        <td>Confirmado</td>
                        <td><button class="styled-button" onclick="window.location.href='url_para_reservar'">Reservar</button></td>

                    </tr>
                    <tr>
                        <td>987654321</td>
                        <td>Paquete 2</td>
                        <td>02/05/2024</td>
                        <td>02/05/2024</td>
                        <td>Reservado</td>
                        <td>Confirmado</td>
                        <td><button class="styled-button" onclick="window.location.href='url_para_reservar'">Reservar</button></td>

                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    

</body>
</html>