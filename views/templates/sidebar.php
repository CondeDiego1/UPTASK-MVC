<aside class="sidebar ocultar">
    <nav class="sidebar-nav">
        <a class="<?php echo($titulo === 'Tus Proyectos') ? 'actual' : '' ?>" href="/dashboard">Proyectos</a>
        <a class="<?php echo($titulo === 'Proyectos en los que participas') ? 'actual' : '' ?>" href="/participante">Proyectos Participantes</a>
        <a class="<?php echo($titulo === 'Crear Proyectos') ? 'actual' : '' ?>" href="/crear_proyectos">Crear Proyectos</a>
        <a class="<?php echo($titulo === 'Perfil') ? 'actual' : '' ?>" href="/perfil">Perfil</a>
        <form method="GET" action="/logout">
            <button class="no-style">Cerrar Sesión</button>
        </form>
    </nav>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flecha fixed" fill="none" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
    </svg>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const flecha = document.querySelector(".flecha");
        const sidebar = document.querySelector(".sidebar");

        // if(screen.width < 800){
            // sidebar.classList.add("ocultar");
            // flecha.classList.add("fixed");
        // }

        flecha.addEventListener("click", function (){
            sidebar.classList.toggle("ocultar");
            flecha.classList.toggle("fixed");
        })
    });
</script>