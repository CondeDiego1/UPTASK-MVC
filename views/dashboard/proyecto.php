<?php include_once __DIR__ . '/header-dashboard.php'; ?>
    <div class="contenedor-sm margin-bottom">
        <div class="contenedor-nueva-tarea">
            <button type="button" class="agregar-tarea" id="agregar-tarea">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 crear-proyecto" fill="none" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div class="filtros" id="filtros">
            <h2>Filtros</h2>
            <div class="filtros-inputs">
                <div class="campo">
                    <input type="radio" name="filtro" id="todas" value="" checked>
                    <label for="todas" class="todas">Todas</label>
                </div>

                <div class="campo">
                    <input type="radio" name="filtro" id="completadas" value="1">
                    <label for="completadas" class="completas">Completadas</label>
                </div>

                <div class="campo">
                    <input type="radio" name="filtro" id="pendientes" value="0">
                    <label for="pendientes" class="pendientes">Pendientes</label>
                </div>
            </div>
        </div>
        <ul id="listado-tareas" class="listado-tareas"></ul>
    </div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="build/js/tareas.js"></script>