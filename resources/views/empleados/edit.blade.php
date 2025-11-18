@extends('layouts.app')

@section('content')
<h2>Editar Empleado</h2>

<form action="{{ route('empleados.update', $empleado) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nombres *</label>
            <input type="text" name="nombres" class="form-control"
                   value="{{ $empleado->nombres }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Apellidos *</label>
            <input type="text" name="apellidos" class="form-control"
                   value="{{ $empleado->apellidos }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Identificación *</label>
            <input type="text" name="identificacion" class="form-control"
                   value="{{ $empleado->identificacion }}" disabled>
        </div>

        <div class="col-md-6 mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="{{ $empleado->telefono }}">
        </div>

        <div class="col-md-6 mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control"
                   value="{{ $empleado->direccion }}">
        </div>

        <!-- País -->
        <div class="col-md-6 mb-3">
            <label>País de nacimiento *</label>
            <select id="pais" name="pais_nacimiento" class="form-select" required>
                <option value="Colombia" {{ $empleado->pais_nacimiento == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                <option value="México" {{ $empleado->pais_nacimiento == 'México' ? 'selected' : '' }}>México</option>
                <option value="Argentina" {{ $empleado->pais_nacimiento == 'Argentina' ? 'selected' : '' }}>Argentina</option>
            </select>
        </div>

        <!-- Ciudad -->
        <div class="col-md-6 mb-3">
            <label>Ciudad de nacimiento *</label>
            <select id="ciudad" name="ciudad_nacimiento" class="form-select" required>
            </select>
        </div>

        <!-- Cargos -->
        <div class="col-md-6 mb-3">
            <label>Cargos *</label>
            <select name="cargos[]" multiple class="form-select" required>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}"
                    {{ $empleado->cargos->contains($cargo->id) ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jefe -->
        <div class="col-md-6 mb-3">
            <label>Jefe inmediato</label>
            <select name="jefe_id" class="form-select">
                <option value="">Sin jefe</option>
                @foreach($jefes as $j)
                    <option value="{{ $j->id }}"
                        {{ $empleado->jefe_id == $j->id ? 'selected' : '' }}>
                        {{ $j->nombres }} {{ $j->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection

@section('scripts')
<script>
    const ciudades = {
        'Colombia': ['Bogotá', 'Medellín', 'Cali'],
        'México': ['CDMX', 'Guadalajara', 'Monterrey'],
        'Argentina': ['Buenos Aires', 'Córdoba', 'Rosario']
    };

    function cargarCiudades() {
        let pais = $('#pais').val();
        let opciones = ciudades[pais] ?? [];
        let ciudadSeleccionada = "{{ $empleado->ciudad_nacimiento }}";

        $('#ciudad').empty();

        opciones.forEach(function(c) {
            let selected = (c === ciudadSeleccionada) ? 'selected' : '';
            $('#ciudad').append(`<option value="${c}" ${selected}>${c}</option>`);
        });
    }

    cargarCiudades();

    $('#pais').change(cargarCiudades);
</script>
@endsection
