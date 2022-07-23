<?php
    foreach($alertas as $key => $alerta) {
        foreach($alerta as $mensaje) {?>
            <div class="alerta <?php echo($key); ?>">
                <?php echo ($mensaje); ?>
            </div>
<?php }} ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const notify = document.getElementsByClassName('alerta');
        for (i = 0; i < notify.length; i++) {
            if (notify[i]) {
                setTimeout(function () {
                    for (j = 0; j < notify.length; j++) {
                        notify[j].classList.add("oculto");
                    }
                }, 9000);
            }
        }
    });
</script>