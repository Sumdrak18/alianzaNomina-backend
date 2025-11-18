@extends('layouts.app')

@section('title', 'Crear Cargo')

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
        .form-control {
            border-radius: 16px !important;
            padding: 0.8rem 1.2rem !important;
            border: 2px solid #e2e8f0;
            font-size: 1.1rem;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.3rem rgba(102, 106, 234, 0.2);
        }
        label {
            font-weight: 600;
            color: #374151;
        }
        .btn-lg {
            padding: 0.8rem 2.5rem;
            font-size: 1.1rem;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">

            <!-- Tarjeta con glassmorphism -->
            <div class="form-card">
                <!-- Cabecera con degradado amarillo-rosa (diferente a empleados) -->
                <div class="text-white text-center py-5 px-4"
                     style="background: linear-gradient(135deg, #feca57, #ff9ff3);">
                    <div class="empleado-avatar mx-auto mb-3 d-flex align-items-center justify-content-center"
                         style="width: 110px; height: 110px; font-size: 3.5rem; box-shadow: 0 12px 30px rgba(0,0,0,0.4); border: 5px solid rgba(255,255,255,0.3);">
                        +
                    </div>
                    <h2 class="mb-0">Crear Nuevo Cargo</h2>
                    <p class="mb-0 opacity-90">Agrega un nuevo cargo al sistema</p>
                </div>

                <div class="p-5">

                    <!-- Mensajes de error bonitos y cerrables -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('cargos.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre del cargo *</label>
                            <input type="text"
                                   name="nombre"
                                   id="nombre"
                                   class="form-control form-control-lg"
                                   value="{{ old('nombre') }}"
                                   required
                                   autofocus
                                   placeholder="Ej: Desarrollador Frontend, Gerente de Ventas..."
                                   autocomplete="off">
                        </div>

                        <!-- Botones grandes y estilo pill -->
                        <div class="d-grid d-md-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('cargos.index') }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-5 order-md-1">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                Crear Cargo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection