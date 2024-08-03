document.addEventListener("DOMContentLoaded", function () {
    const brand = document.querySelector('#form-brand [name="brand_id"]');
    brand.addEventListener("change", async function () {
        const id = brand.value;
       console.log(id);
        try {
            const response = await fetch(`brands/${id}/find`);
            const data = await response.json();
            console.log(data);
            const body = document.querySelector('#table-body');
            body.innerHTML = '';
            data.forEach(element => {
                const row = document.createElement('tr');
                const td = document.createElement('td');
                const imagen = document.createElement('img');
                const btnTd = document.createElement('td');
                const btn = document.createElement('a');
                btn.classList.add('boton');
                btn.classList.add('azul');
                btn.href = "/petfood/public/products/" + element.id +"/details";
                btn.innerHTML = "ver";
                const desc = document.createElement('td');
                imagen.src = "upload/"+element.image;
                imagen.classList.add('mini-imagen');
                desc.textContent =element.race + ' '+ element.flavor ;
                td.appendChild(imagen);
                btnTd.appendChild(btn)
                row.appendChild(td);
                row.appendChild(desc);
                row.appendChild(btnTd);
                body.appendChild(row);
            });
        } catch (error) {
            console.error("Error al obtener detalles del producto", error);
        }
    });
});
