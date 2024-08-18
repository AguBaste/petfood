document.addEventListener("DOMContentLoaded", function () {
    const select = document.querySelector('#form-venta [name="product"]');
    select.addEventListener("change", async function () {
        const id = select.value;
        const precioBolsa = document.querySelector('#precioBolsa');
        const precioKilo = document.querySelector('#precioKilo')
        const contenedor = document.querySelector('.contenedor-foto-precio');
        const img = document.querySelector('[name="img"]');

        try {
            const response = await fetch(`products/${id}/valor`);
            const data = await response.json();
<<<<<<< HEAD
            console.log(data);
            contenedor.style.display = 'flex';
            precioBolsa.innerHTML += data.bolsa ;
            precioKilo.innerHTML += data.kilo
=======
            contenedor.style.display = 'flex';
            precioBolsa.innerHTML = data.bolsa ;
            precioKilo.innerHTML = data.kilo
>>>>>>> b7121499d4a80c2c0e795e429600815ab30eab48
            img.src = "upload/"+data.image;
        } catch (error) {
            console.error("Error al obtener detalles del producto", error);
        }
    });
});
