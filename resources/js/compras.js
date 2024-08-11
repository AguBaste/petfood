document.addEventListener("DOMContentLoaded", function () {
    const productSelect = document.querySelector(
        '#form-compras [name="product"]'
    );

    productSelect.addEventListener("change", async function () {
        const productId = productSelect.value;
        const contenedor = document.querySelector(".contenedor-foto-precio");
        const priceInput = document.querySelector('[name="price"]');
        const img = document.querySelector('[name="img"]');
        try {
            const response = await fetch(`products/${productId}/complete`); // Cambia la ruta a tu endpoint para obtener detalles del producto
            const data = await response.json();
            // Actualiza los campos de cantidad y precio
            contenedor.style.display = "flex";
            priceInput.value = data.price;
            img.src = "upload/" + data.image;
        } catch (error) {
            console.error("Error al obtener detalles del producto:", error);
        }
    });
});
