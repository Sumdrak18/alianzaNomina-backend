@extends('layouts.app')

@section('title', 'Editar Cargo')

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

            <!-- Tarjeta principal con glassmorphism -->
            <div class="form-card">
                <div class="text-white text-center py-5 px-4"
                     style="background: linear-gradient(135deg, #feca57, #ff9ff3);">
                    <div class="empleado-avatar mx-auto mb-3 d-flex align-items-center justify-content-center"
                         style="width: 110px; height: 110px; font-size: 2.8rem; box-shadow: 0 12px 30px rgba(0,0,0,0.4);">
                        {{ strtoupper(substr($cargo->nombre, 0, 2)) }}
                    </div>
                    <h2 class="mb-0">Editar Cargo</h2>
                    <p class="mb-0 opacity-90">{{ $cargo->nombre }}</p>
                </div>

                <div class="p-5">

                    {{-- Mensajes de error bonitos --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
                            <strong>Error en el formulario:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('cargos.update', $cargo) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre del cargo *</label>
                            <input type="text"
                                   name="nombre"
                                   id="nombre"
                                   class="form-control form-control-lg"
                                   value="{{ old('nombre', $cargo->nombre) }}"
                                   required
                                   autofocus
                                   placeholder="Ej: Gerente de Ventas">
                        </div>

                        <div class="d-grid d-md-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('cargos.index') }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                Actualizar Cargo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection