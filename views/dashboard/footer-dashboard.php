</div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const perfil_dashboard = document.querySelector(".perfil-dashboard");
        const cuenta = document.querySelector(".cuenta");

        perfil_dashboard.addEventListener("click", function (){
            cuenta.classList.toggle("no-visible");
        })
    });
</script>