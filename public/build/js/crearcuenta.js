function imagenAvatar(){document.querySelector(".avatar").value=$("#fichero").attr("src").substring(10,17)}function iniciarApp(){let e=document.querySelector("#contraseña"),r=document.querySelector("#contraseña2"),t=document.querySelector("#control");if(e&&("password"===e.type?t.src="build/img/visible48.png":t.src="build/img/ojo48.png"),r){let e=document.querySelector("#control2");if("password"===r.type)return void(e.src="build/img/visible48.png");e.src="build/img/ojo48.png"}}function cambiarAvatar(){const e=document.querySelectorAll(".perfil"),r=document.querySelector("#fichero");e.forEach(e=>{e.addEventListener("click",e=>{switch(parseInt(e.target.dataset.paso)){case 1:r.src="build/img/perfil1.webp";break;case 2:r.src="build/img/perfil2.webp";break;case 3:r.src="build/img/perfil3.webp";break;case 4:r.src="build/img/perfil4.webp";break;case 5:r.src="build/img/perfil5.webp";break;case 6:r.src="build/img/perfil6.webp";break;case 7:r.src="build/img/perfil7.webp";break;case 8:r.src="build/img/perfil8.webp"}imagenAvatar()})})}function verContraseña(){const e=document.querySelector(".vercontraseña");e&&e.addEventListener("click",(function(){let e=document.querySelector("#contraseña"),r=document.querySelector("#control");if("password"===e.type)return e.type="text",void(r.src="build/img/ojo48.png");e.type="password",r.src="build/img/visible48.png"}))}function verContraseña2(){const e=document.querySelector(".vercontraseña2");e&&e.addEventListener("click",(function(){let e=document.querySelector("#contraseña2"),r=document.querySelector("#control2");if("password"===e.type)return e.type="text",void(r.src="build/img/ojo48.png");e.type="password",r.src="build/img/visible48.png"}))}document.addEventListener("DOMContentLoaded",(function(){iniciarApp(),cambiarAvatar(),verContraseña(),verContraseña2(),imagenAvatar()}));