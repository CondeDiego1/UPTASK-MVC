<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Ingresa tu nueva contraseña</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <?php if($error === false){ ?>
            <form method="POST" class="formulario">
                <div class="contenedor-ver">
                    <div class="campo">
                        <input type="password" id="contraseña" name="password" placeholder="Contraseña" required autocomplete="off">
                        <label for="" class="label">Nueva contraseña</label>
                    </div>
                    <label class="check" onclick="myFunction()" for="vercontraseña"><img id="control" src="" alt="imagen login"></label>
                </div>
                
                <input type="submit" value="Cambiar Contraseña" class="boton">
            </form>
        <?php } ?>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
            <a href="/create_account">¿Aún no tienes una cuenta? Registrarse</a>
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

    // var y = document.getElementById("contraseña2");
    // const control2 = document.getElementById("control2");
    // if (y.type === "password") {
    //     control2.src = "/build/img/visible48.png";
    // } else {
    //     control2.src = "/build/img/ojo48.png";
    // }
    // function myFunction2() {
    //     var y = document.getElementById("contraseña2");
    //     const control2 = document.getElementById("control2");
    //     if (y.type === "password") {
    //         y.type = "text";
    //         control2.src = "/build/img/ojo48.png";
    //     } else {
    //         y.type = "password";
    //         control2.src = "/build/img/visible48.png";
    //     }
    // }
</script>

<?php if($error === true) { echo "<script>
    function login(){
        location.href= '/';
    }
    setTimeout(login, 7000);
    </script>";
} ?>

<?php if(isset($bandera)) { echo "<script>
    function login(){
        location.href= '/';
    }
    setTimeout(login, 4000);
    </script>";
} ?>