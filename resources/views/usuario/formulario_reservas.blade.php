<x-headusuario></x-headusuario>

<!-- DATOS PERSONALES -->
<h1>Reservacion de paquetes</h1>
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
</form>


<!-- FORMULARIO DE PAGO -->


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
</form>




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
