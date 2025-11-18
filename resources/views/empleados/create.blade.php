@extends('layouts.app')

@section('title', 'Crear Empleado')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados-index.css') }}?v={{ time() }}">
    <style>
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
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
        .btn-lg {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
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

            <!-- Tarjeta principal -->
            <div class="form-card">
                <div class="text-white text-center py-5 px-4"
                     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="empleado-avatar mx-auto mb-3 d-flex align-items-center justify-content-center"
                         style="width: 110px; height: 110px; font-size: 3rem; box-shadow: 0 12px 30px rgba(0,0,0,0.4); border: 4px solid rgba(255,255,255,0.3);">
                        New User
                    </div>
                    <h2 class="mb-0">Crear Nuevo Empleado</h2>
                    <p class="mb-0 opacity-90">Complete todos los campos obligatorios</p>
                </div>

                <div class="p-5">
                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Nombres y Apellidos -->
                            <div class="col-md-6">
                                <label>Nombres *</label>
                                <input type="text" name="nombres" class="form-control form-control-lg"
                                       value="{{ old('nombres') }}" required placeholder="Juan Pablo">
                            </div>
                            <div class="col-md-6">
                                <label>Apellidos *</label>
                                <input type="text" name="apellidos" class="form-control form-control-lg"
                                       value="{{ old('apellidos') }}" required placeholder="García López">
                            </div>

                            <!-- Identificación -->
                            <div class="col-md-6">
                                <label>Identificación *</label>
                                <input type="text" name="identificacion" class="form-control form-control-lg"
                                       value="{{ old('identificacion') }}" required placeholder="123456789">
                            </div>

                            <!-- Teléfono y Dirección -->
                            <div class="col-md-6">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control form-control-lg"
                                       value="{{ old('telefono') }}" placeholder="+57 300 123 4567">
                            </div>
                            <div class="col-12">
                                <label>Dirección</label>
                                <input type="text" name="direccion" class="form-control form-control-lg"
                                       value="{{ old('direccion') }}" placeholder="Calle 123 #45-67, Barrio Centro">
                            </div>

                            <!-- País y Ciudad -->
                            <div class="col-md-6">
                                <label>País de nacimiento *</label>
                                <select id="pais" name="pais_nacimiento" class="form-select form-select-lg" required>
                                    <option value="">Seleccione país...</option>
                                    <option value="Colombia" {{ old('pais_nacimiento') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                    <option value="México" {{ old('pais_nacimiento') == 'México' ? 'selected' : '' }}>México</option>
                                    <option value="Argentina" {{ old('pais_nacimiento') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Ciudad de nacimiento *</label>
                                <select id="ciudad" name="ciudad_nacimiento" class="form-select form-select-lg" required>
                                    <option value="">Seleccione país primero...</option>
                                </select>
                            </div>

                            <!-- Cargos múltiples -->
                            <div class="col-md-6">
                                <label>Cargos *</label>
                                <select name="cargos[]" multiple class="form-select form-select-lg" size="5" required>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}"
                                            {{ collect(old('cargos'))->contains($cargo->id) ? 'selected' : '' }}>
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Ctrl + clic para seleccionar varios</small>
                            </div>

                            <!-- Jefe -->
                            <div class="col-md-6">
                                <label>Jefe inmediato</label>
                                <select name="jefe_id" class="form-select form-select-lg">
                                    <option value="">Sin jefe (opcional)</option>
                                    @foreach($jefes as $jefe)
                                        <option value="{{ $jefe->id }}"
                                            {{ old('jefe_id') == $jefe->id ? 'selected' : '' }}>
                                            {{ $jefe->nombres }} {{ $jefe->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid d-md-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('empleados.index') }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                Crear Empleado
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection