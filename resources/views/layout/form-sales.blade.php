<form action="{{ route('sales.index') }}" method="get" class="form form-chico">
    @csrf

    <label for="date"> seleccione un mes</label>
    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}">

    <x-input-btn>
        <x-slot name="class">
            boton-form azul
        </x-slot>
        <x-slot name="value">
            buscar
        </x-slot>
    </x-input-btn>

    <span>
        @error('date')
            {{ $message }}
        @enderror
    </span>

</form>
