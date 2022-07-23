<div class="contenedor confirmacion">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Estás a un solo paso de disfrutar de todos los servicios. Ingresa a tu email y busca el mensaje que te hemos enviado para confirmar tu cuenta.</p>
        <div class="lds-spinner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    </div><!--.contenedor-sm-->
</div>
<?php echo "<script>
    function login(){
        location.href= '/';
    }
    setTimeout(login, 8000);
    </script>";
?>