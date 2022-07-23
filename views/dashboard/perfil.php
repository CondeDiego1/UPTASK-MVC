<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario editar-perfil" action="/perfil" method="POST" novalidate>
        <p class="descripcion-pagina ps d espaciado">Avatar</p>
        <div class="flex">
            <img src="build/img/<?php echo($usuario->fotoperfil); ?>.webp" id="fichero" alt="Avatar" name="foto" class="fotoperfil" lazy="loading">
        </div>
        <div class="switch-field">
            <input type="radio" id="perfil1" name="perfil" checked readonly/>
            <label for="perfil1" data-paso="1" class="perfil"></label>

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
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo($usuario->email); ?>" required disabled>
            <label for="email" class="label">Email</label>
        </div>

        <div class="contenedor-ver">
            <div class="campo">
                <input type="password" id="contraseña" name="password" placeholder="Contraseña" autocomplete="off">
                <label for="password" class="label">Contraseña Actual</label>
            </div>
            <label class="check" onclick="myFunction()" for="vercontraseña"><img id="control" src="" alt="imagen login"></label>
        </div>

        <div class="contenedor-ver">
            <div class="campo">
                <input type="password" id="contraseña2" name="password2" placeholder="Contraseña2" autocomplete="off" required>
                <label for="password2" class="label">Contraseña Nueva</label>
            </div>
            <label class="check" onclick="myFunction2()" for="vercontraseña"><img id="control2" src="" alt="imagen login"></label>
        </div>
        <p class="consejo-password"><span>*</span>Si no deseas cambiar la contraseña deja los campos de password en blanco.</p>

        <input type="submit" value="Guardar Cambios" class="boton">
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="build/js/crearcuenta.js"></script>
<?php 
    if(isset($script) && $script == true){
        echo "
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Perfil Actualizado',
                text: 'Tus cambios se guardaron correctamente.',
                button: 'OK',
            }).then(() => {
                location.href='/perfil';
            });
        </script>
        ";
    } else if(isset($script) && $script == false) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No pudimos guardar tus cambios, intenta nuevamente más tarde.',
            }).then(() => {
                location.href='/perfil';
            });
        </script>";
    }
?>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>