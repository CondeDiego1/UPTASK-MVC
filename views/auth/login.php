<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/" method="POST" class="formulario" novalidate>
            <div class="campo">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <label for="email" class="label">Email</label>
            </div>
            
            <div class="contenedor-ver">
                <div class="campo">
                    <input type="password" id="contraseña" name="password" placeholder="Contraseña" required autocomplete="off">
                    <label for="contraseña" class="label">Contraseña</label>
                </div>
                <label class="check" onclick="myFunction()" for="vercontraseña"><img id="control" src="" alt="imagen login"></label>
            </div>
            <input type="submit" value="Iniciar Sesión" class="boton">
        </form>

        <div class="acciones">
            <a href="/crear_cuenta">¿Aún no tienes una cuenta? Registrarse</a>
            <a href="/recuperar_password">¿Perdiste tu contraseña?</a>
        </div>
    </div><!--.contenedor-sm-->
</div>

<script>
    var x = document.getElementById("contraseña");
    const control = document.getElementById("control");
    if (x.type === "password") {
        control.src = "/build/img/visible48.png";
    } else {
        control.src = "/build/img/ojo48.png";
    }
    function myFunction() {
        var x = document.getElementById("contraseña");
        const control = document.getElementById("control");
        if (x.type === "password") {
            x.type = "text";
            control.src = "/build/img/ojo48.png";
        } else {
            x.type = "password";
            control.src = "/build/img/visible48.png";
        }
    }
</script>