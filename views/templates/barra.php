<div class="barra">
    <div class="contenedor-flex contenedor-flex__background">
        <img src="build/img/icono2.svg" alt="Icono UpTask">
        <a href="/dashboard"><h2>UpTask</h2></a>
    </div>
    <p class="nombre-usuario">¡Hola, <span><?php echo($_SESSION['nombre']); ?></span>!</p>
    <div class="contenedor-flex">
        <?php 
            $uri = $_SERVER["REQUEST_URI"];
            $findme = '/proyecto?';
            $pos = strpos($uri , $findme);
            if($pos === 0 && $proyecto->propietario === $_SESSION['codigousuario']){ ?>
            <div class="contenedor-svg-info contenedor-svg-info__equipo" id="equipo">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" viewBox="0 0 24 24" stroke="#42526E" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle class="circle" cx="9" cy="7" r="4" />
                    <path class="cbody" d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    <path class="plus" d="M16 11h6m-3 -3v6" />
                    <title>Agregar al equipo</title>
                </svg>
            </div><!-- icono agregar usuario -->

            <div class="contenedor-svg-info" id="nueva-tarea">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#42526E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path class="path1" d="M13 5h8" />
                    <path class="path2" d="M13 9h5" />
                    <path class="path3" d="M13 15h8" />
                    <path class="path4" d="M13 19h5" />
                    <rect class="rect1" x="3" y="4" width="6" height="6" rx="1" />
                    <rect class="rect2" x="3" y="14" width="6" height="6" rx="1" />
                    <title>Crear tarea</title>
                </svg>
            </div><!-- icono crear tarea -->
        <?php } ?> 

        <div class="contenedor-svg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 crear-proyecto" fill="none" viewBox="0 0 24 24" stroke="#42526E" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                <title>Crear proyecto</title>
            </svg>
        </div><!-- icono crear proyecto -->

        <div class="contenedor-svg-info contenedor-svg-info__giro">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#42526E" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                <title>Información</title>
            </svg>
        </div><!-- icono información -->

        <img title="Perfil" src="build/img/<?php echo(trim($_SESSION['avatar']) . '.webp'); ?>" class="perfil-dashboard" alt="Avatar" lazy="loading">
    </div>
    <input type="hidden" name="" class="codigousuario" value="<?php echo($_SESSION['codigousuario']); ?>">
</div>

<script src="assets/sweetalert2.min.js"></script>
<script src="build/js/FetchAPI_proyecto.js"></script>
<script defer src="build/js/añadirusuario.js"></script>