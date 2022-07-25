<div class="dashboard">
    <div class="cuenta no-visible">
        <h2>Cuenta</h2>
        <section class="informacion-cuenta">
            <img src="build/img/<?php echo(trim($_SESSION['avatar']) . '.webp'); ?>" alt="Avatar" class="fichero">
            <div>
                <h3><?php echo($_SESSION['nombre']); ?></h3>
                <p><?php echo($_SESSION['email']); ?></p>
            </div>
        </section>
        <ul class="menu-cuenta">
            <li><a href="/dashboard">Proyectos</a></li>
            <li><a href="/participante">Proyectos Participantes</a></li>
            <li><a href="/crear_proyectos">Crear Proyectos</a></li>
            <li><a href="/perfil">Perfil</a></li>
        </ul>

        <form method="GET" action="/logout">
            <button class="cerrar-session">Cerrar Sesión</button>
        </form>
    </div>

    <?php include_once __DIR__ . '/../templates/barra.php'?>
    <div class="principal">
        <?php include_once __DIR__ . '/../templates/sidebar.php'?>
        <div class="contenido active">
            <h2 class="nombre-pagina">
                <?php 
                if($titulo === "Tus Proyectos" || $titulo === "Perfil" || $titulo === "Proyectos en los que participas" || $titulo === "Crear Proyectos") { 
                    echo($titulo);  
                } else { ?>
                    <span>Proyecto</span> <?php echo($titulo);
                } ?>
            </h2>
