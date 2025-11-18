@extends('layouts.app')

@section('title', 'Editar Empleado')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados-index.css') }}?v={{ time() }}">
    <style>
        /* Estilos específicos para formularios */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }
        .form-control, .form-select {
            border-radius: 16px !important;
            padding: 0.75rem 1rem !important;
            border: 2px solid #e2e8f0;
            font-size: 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.3rem rgba(102, 106, 234, 0.2);
        }
        label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/empleado-form.js') }}?v={{ time() }}"></script>
@endpush

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">

            <!-- Tarjeta principal con glassmorphism -->
            <div class="form-card overflow-hidden">
                <div class="text-white text-center py-5 px-4"
                     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="empleado-avatar mx-auto mb-3"
                         style="width: 100px; height: 100px; font-size: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        {{ substr($empleado->nombres, 0, 1) }}{{ substr($empleado->apellidos, 0, 1) }}
                    </div>
                    <h2 class="mb-0">Editar Empleado</h2>
                    <p class="mb-0 opacity-90">{{ $empleado->nombres }} {{ $empleado->apellidos }}</p>
                </div>

                <div class="p-5">
                    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="row g-4">
                            <!-- Nombres y Apellidos -->
                            <div class="col-md-6">
                                <label>Nombres *</label>
                                <input type="text" name="nombres" class="form-control form-control-lg"
                                       value="{{ old('nombres', $empleado->nombres) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label>Apellidos *</label>
                                <input type="text" name="apellidos" class="form-control form-control-lg"
                                       value="{{ old('apellidos', $empleado->apellidos) }}" required>
                            </div>

                            <!-- Identificación (solo lectura) -->
                            <div class="col-md-6">
                                <label>Identificación</label>
                                <input type="text" class="form-control form-control-lg bg-light"
                                       value="{{ $empleado->identificacion }}" disabled>
                            </div>

                            <!-- Teléfono y Dirección -->
                            <div class="col-md-6">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control form-control-lg"
                                       value="{{ old('telefono', $empleado->telefono) }}">
                            </div>
                            <div class="col-12">
                                <label>Dirección</label>
                                <input type="text" name="direccion" class="form-control form-control-lg"
                                       value="{{ old('direccion', $empleado->direccion) }}">
                            </div>

                            <!-- País y Ciudad -->
                            <div class="col-md-6">
                                <label>País de nacimiento *</label>
                                <select id="pais" name="pais_nacimiento" class="form-select form-select-lg" required>
                                    <option value="Colombia" {{ old('pais_nacimiento', $empleado->pais_nacimiento) == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                    <option value="México" {{ old('pais_nacimiento', $empleado->pais_nacimiento) == 'México' ? 'selected' : '' }}>México</option>
                                    <option value="Argentina" {{ old('pais_nacimiento', $empleado->pais_nacimiento) == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Ciudad de nacimiento *</label>
                                <select id="ciudad" name="ciudad_nacimiento" class="form-select form-select-lg" required>
                                    <!-- Se llena con JS -->
                                </select>
                            </div>

                            <!-- Cargos (múltiple) -->
                            <div class="col-md-6">
                                <label>Cargos *</label>
                                <select name="cargos[]" multiple class="form-select form-select-lg" size="4" required>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}"
                                            {{ $empleado->cargos->contains($cargo->id) ? 'selected' : '' }}>
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Mantén presionado Ctrl (o Cmd) para seleccionar varios</small>
                            </div>

                            <!-- Jefe -->
                            <div class="col-md-6">
                                <label>Jefe inmediato</label>
                                <select name="jefe_id" class="form-select form-select-lg">
                                    <option value="">Sin jefe</option>
                                    @foreach($jefes as $jefe)
                                        <option value="{{ $jefe->id }}"
                                            {{ old('jefe_id', $empleado->jefe_id) == $jefe->id ? 'selected' : '' }}>
                                            {{ $jefe->nombres }} {{ $jefe->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid d-md-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('empleados.index') }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-5 order-md-last">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                Actualizar Empleado
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
