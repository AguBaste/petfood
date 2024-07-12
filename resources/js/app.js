const { document } = require("postcss");

// En tu archivo JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const select = document.querySelector('#form-venta [name="product"]');
    const precio = document.querySelector('[name="precio"]');

    select.addEventListener('change',async function(){
        const id = select.value;
        console.log(id);
        try{
            const response = await fetch(`products/${id}/complete`);
            const data = await response.json();
            precio.value = data.price;
        }catch(error){
            console.error('Error al obtener detalles del producto',error);
        }
    });

    const productSelect = document.querySelector('#form-compras [name="product"]');
    const quantityInput = document.querySelector('[name="quantity"]');
    const priceInput = document.querySelector('[name="price"]');

    productSelect.addEventListener('change', async function() {
        const productId = productSelect.value;

        try {
            const response = await fetch(`products/${productId}/complete`); // Cambia la ruta a tu endpoint para obtener detalles del producto
            const data = await response.json();

            // Actualiza los campos de cantidad y precio
            quantityInput.value = data.weight;
            quantityInput.step = data.weight;
            priceInput.value = data.price;
        } catch (error) {
            console.error('Error al obtener detalles del producto:', error);
        }
    });
});
