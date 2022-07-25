<?php include_once __DIR__ . '/header-dashboard.php'; ?>
    <?php  if(count($proyectos) !== 0){ ?>
        <ul class="listado-proyectos">
            <?php foreach($proyectos as $proyecto) { ?>
                <li class="proyecto">
                    <a href="/proyecto?id=<?php echo($proyecto->url) ?>">
                        <?php echo($proyecto->nombreproyecto) ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p class="no-proyectos">Aún no participas en proyectos.</p>
    <?php } ?>
    
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>