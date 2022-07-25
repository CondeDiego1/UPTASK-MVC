<?php include_once __DIR__ . '/header-dashboard.php'; ?>
    <?php  if(count($proyectos) !== 0){ ?>
        <ul class="listado-proyectos">
            <?php foreach($proyectos as $proyecto) { ?>
                <li class="proyecto">
                    <a href="/proyecto?id=<?php echo($proyecto->url) ?>">
                        <?php echo($proyecto->nombreproyecto) ?>
                    </a>
                    <?php if($proyecto->grupo != 0){ ?>
                    <!-- <img title="Perfil" src="build/img/<?php echo(trim($_SESSION['avatar']) . '.webp'); ?>" class="p" alt="Avatar" lazy="loading"> -->
                        <div class="grupo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" viewBox="0 0 24 24" stroke="#42526E" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle class="circle" cx="9" cy="7" r="4" />
                                <path class="cbody" d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path class="plus" d="M16 11h6m-3 -3v6" />
                                <title>Participantes</title>
                            </svg>
                        </div><!-- icono agregar usuario -->
                    <?php } ?>
                </li>
                
            <?php } ?>
            
        </ul>
    <?php } else { ?>
        <p class="no-proyectos">Aún no tienes proyectos.</p>
    <?php } ?>
    
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>



