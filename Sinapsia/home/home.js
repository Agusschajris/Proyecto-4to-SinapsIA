const botonPerfil = document.querySelector(".perfil");
const perfil = document.querySelector(".perfilDoctor");

botonPerfil.addEventListener ("click", ()=>{
    perfil.classList.toggle("open");
});