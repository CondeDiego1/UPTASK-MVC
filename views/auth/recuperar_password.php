<div class="contenedor recuperar">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar tu acceso</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?> 
        <!-- No se ponde action porque recibe un token y ponerlo quita la referencia -->
        <form action="/recover_password" method="POST" class="formulario" id="myForm">
            <div class="campo">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <label for="" class="label">Email</label>
            </div>
            <input type="submit" value="Enviar Instrucciones" class="boton" id="enviar">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
            <a href="/crear_cuenta">¿Aún no tienes una cuenta? Registrarse</a>
        </div>
    </div><!--.contenedor-sm-->
</div>
<div id="contenedor-load" class="oculto">
    <div class="loader oculto"></div>
</div>
<script src="build/js/preload.js" defer></script>