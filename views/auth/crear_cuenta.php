<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear cuenta</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/crear_cuenta" method="POST" class="formulario ps" novalidate>
            <p class="descripcion-pagina ps d">Selecciona un avatar para tu perfil</p>
            <div class="flex">
                <img src="build/img/perfil1.webp" id="fichero" alt="Avatar" name="foto" class="fotoperfil" lazy="loading">
            </div>
            <div class="switch-field">
                <input type="radio" id="perfil1" name="perfil" checked readonly/>
                <label for="perfil1" data-paso="1" class="perfil" style="cursor:pointer;"></label>

                <input type="radio" id="perfil2" name="perfil" readonly/>
                <label for="perfil2" data-paso="2" class="perfil"></label>

                <input type="radio" id="perfil3" name="perfil" readonly/>
                <label for="perfil3" data-paso="3" class="perfil"></label>

                <input type="radio" id="perfil4" name="perfil" readonly/>
                <label for="perfil4" data-paso="4" class="perfil"></label>

                <input type="radio" id="perfil5" name="perfil" readonly/>
                <label for="perfil5" data-paso="5" class="perfil"></label>

                <input type="radio" id="perfil6" name="perfil" readonly/>
                <label for="perfil6" data-paso="6" class="perfil"></label>

                <input type="radio" id="perfil7" name="perfil" readonly/>
                <label for="perfil7" data-paso="7" class="perfil"></label>

                <input type="radio" id="perfil8" name="perfil" readonly/>
                <label for="perfil8" data-paso="8" class="perfil"></label>

            </div>
            <input type="hidden" name="fotoperfil" class="avatar">

            <div class="campo">
                <input type="nombre" id="nombre" name="nombre" placeholder="nombre" value="<?php echo($usuario->nombre); ?>" required>
                <label for="nombre" class="label">Nombre</label>
            </div>

            <div class="campo">
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo($usuario->email); ?>" required>
                <label for="email" class="label">Email</label>
            </div>
            
            <div class="contenedor-ver">
                <div class="campo">
                    <input type="password" id="contraseña" name="password" placeholder="Contraseña" autocomplete="off" required>
                    <label for="password" class="label">Contraseña</label>
                </div>
                <label class="check vercontraseña"><img id="control" src="" alt="ver contraseña"></label>
            </div>

            <div class="contenedor-ver">
                <div class="campo">
                    <input type="password" id="contraseña2" name="password2" placeholder="Contraseña2" autocomplete="off" required>
                    <label for="password2" class="label">Repetir contraseña</label>
                </div>
                <label class="check vercontraseña2"><img id="control2" src="" alt="ver contraseña"></label>
            </div>
            <input type="submit" value="Crear Cuenta" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
            <a href="/recuperar_password">¿Perdiste tu contraseña?</a>
        </div>
    </div><!--.contenedor-sm-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="build/js/crearcuenta.js"></script>


