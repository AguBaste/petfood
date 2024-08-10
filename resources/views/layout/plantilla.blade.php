<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">


</head>

<body>
    <main class="contenedor">
        <aside class="barra">
            <h3>Pet Food</h3>
            <div class="barra-lista">
                <p><a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'activo' : '' }}">inicio</a></p>
                <p><a href="{{ route('cart.index') }}"
                        class="{{ request()->routeIs('cart.index') ? 'activo' : '' }}">ingreso caja</a></p>
                <p><a
                        href="{{ route('stock.index') }}"class="{{ request()->routeIs('stock.index') ? 'activo' : '' }}">Stock</a>
                </p>
                <p><a
                        href="{{ route('stockCart.index') }}"class="{{ request()->routeIs('stockCart.index') ? 'activo' : '' }}">compras</a>
                </p>
                <p><a
                        href="{{ route('brands.index') }}"class="{{ request()->routeIs('brands.index') ? 'activo' : '' }}">marcas</a>
                </p>
                <p><a
                        href="{{ route('races.index') }}"class="{{ request()->routeIs('races.index') ? 'activo' : '' }}">Razas</a>
                </p>
                <p><a
                        href="{{ route('flavors.index') }}"class="{{ request()->routeIs('flavors.index') ? 'activo' : '' }}">Sabores</a>
                </p>
                <p><a
                        href="{{ route('providers.index') }}"class="{{ request()->routeIs('providers.index') ? 'activo' : '' }}">Proveedores</a>
                </p>
                <p><a
                        href="{{ route('products.create') }}"class="{{ request()->routeIs('products.index') ? 'activo' : '' }}">alimento
                        para venta</a></p>
                <p><a
                        href="{{ route('sales.index') }}"class="{{ request()->routeIs('sales.index') ? 'activo' : '' }}">resumen
                        de Ventas</a></p>
                <p><a
                        href="{{ route('purchases.index') }}"class="{{ request()->routeIs('purchases.index') ? 'activo' : '' }}">resumen
                        de compras</a></p>
                <p><a
                        href="{{ route('aumentos.index') }}"class="{{ request()->routeIs('aumentos.index') ? 'activo' : '' }}">Aumentos
                        por marca</a></p>
                <p><a
                        href="{{ route('configurations.index') }}"class="{{ request()->routeIs('configurations.index') ? 'activo' : '' }}">Configuraciones</a>
                </p>
                <p><a
                        href="{{ route('security.index') }}"class="{{ request()->routeIs('security.index') ? 'activo' : '' }}">copia
                        seguridad</a></p>

            </div>
        </aside>
        <div class="vista">
            <div class="modal ocultar" id="modal">
                <h2>realmente quiere borrar este producto</h2>
                <a class="boton azul" id="cancelar" href="">cancelar</a>
                <a class="boton rojo" id="borrar" href="">borrar</a>
            </div>
            @if (session('status'))
                <div class="exito">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    @vite(['resources/js/app.js', 'resources/js/venta.js', 'resources/js/mostrar.js','resources/js/compras.js'])
</body>

</html>
