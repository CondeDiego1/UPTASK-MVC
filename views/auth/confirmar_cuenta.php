<div class="contenedor confirmar">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <!-- <div class="acciones">
            <a href="/">Iniciar Sesión</a>
        </div> -->
    </div><!--.contenedor-sm-->
</div>

<?php echo "<script>
    function login(){
        location.href= '/';
    }
    setTimeout(login, 7000);
    </script>";
?>
