document.addEventListener('DOMContentLoaded',()=>{
    const boton = document.getElementById('cerrar');
    boton.addEventListener('click',()=>{
        const status = document.getElementById('modal');
        status.classList.toggle('ocultar');
    });
});