@extends('layouts.app')

@section('content')
<h2>Crear Empleado</h2>

<form action="{{ route('empleados.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nombres *</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Apellidos *</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Identificación *</label>
            <input type="text" name="identificacion" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <!-- PAÍS -->
        <div class="col-md-6 mb-3">
            <label>País de nacimiento *</label>
            <select id="pais" name="pais_nacimiento" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Colombia">Colombia</option>
                <option value="México">México</option>
                <option value="Argentina">Argentina</option>
            </select>
        </div>

        <!-- CIUDAD -->
        <div class="col-md-6 mb-3">
            <label>Ciudad de nacimiento *</label>
            <select id="ciudad" name="ciudad_nacimiento" class="form-select" required>
                <option value="">Seleccione un país primero</option>
            </select>
        </div>

        <!-- CARGOS -->
        <div class="col-md-6 mb-3">
            <label>Cargos *</label>
            <select name="cargos[]" multiple class="form-select" required>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- JEFE -->
        <div class="col-md-6 mb-3">
            <label>Jefe inmediato</label>
            <select name="jefe_id" class="form-select">
                <option value="">Sin jefe</option>
                @foreach($jefes as $j)
                    <option value="{{ $j->id }}">{{ $j->nombres }} {{ $j->apellidos }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-primary">Guardar</button>
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

    $('#pais').change(function() {
        let pais = $(this).val();
        let opciones = ciudades[pais] ?? [];

        $('#ciudad').empty().append('<option value="">Seleccione...</option>');

        opciones.forEach(function(c) {
            $('#ciudad').append(`<option value="${c}">${c}</option>`);
        });
    });
</script>
@endsection
