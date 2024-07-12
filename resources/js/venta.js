document.addEventListener("DOMContentLoaded", function () {
    const select = document.querySelector('#form-venta [name="product"]');
    select.addEventListener("change", async function () {
        const id = select.value;
        const precio = document.querySelector('#precio');
        const contenedor = document.querySelector('.contenedor-foto-precio');
        const img = document.querySelector('[name="img"]');

        try {
            const response = await fetch(`products/${id}/valor`);
            const data = await response.json();
            console.log(data);
            contenedor.style.display = 'flex';
            precio.innerHTML = "$ " + data.price ;
            img.src = "upload/"+data.image;
        } catch (error) {
            console.error("Error al obtener detalles del producto", error);
        }
    });
});
