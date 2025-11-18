@extends('layouts.app')

@section('title', 'Cargos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados-index.css') }}?v={{ time() }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/empleados-index.js') }}?v={{ time() }}"></script>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Cabecera idéntica a Empleados -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h1 class="h3 mb-0">Listado de Cargos</h1>

        <div class="d-flex gap-2 flex-wrap">
            <input type="text" 
                   id="search" 
                   class="form-control form-control-lg rounded-pill ps-5" 
                   placeholder="Buscar cargo..." 
                   autocomplete="off">
            <a href="{{ route('cargos.create') }}" 
               class="btn btn-success btn-lg rounded-pill shadow-sm">
                + Nuevo Cargo
            </a>
        </div>
    </div>

    <!-- MISMA CLASE que en Empleados → mismo diseño automático -->
    <div class="empleados-list">
        @forelse($cargos as $cargo)
            <div class="empleado-item">
                <!-- Avatar igual que empleados, pero color diferente para diferenciar -->
                <div class="empleado-avatar" style="background: linear-gradient(135deg, #feca57, #ff9ff3);">
                    {{ strtoupper(substr($cargo->nombre, 0, 2)) }}
                </div>

                <div class="empleado-info">
                    <h5 class="mb-1 fw-bold">{{ $cargo->nombre }}</h5>
                    <small class="text-muted">ID: {{ $cargo->id }}</small>
                </div>

                <div class="empleado-acciones">
                    <a href="{{ route('cargos.edit', $cargo) }}" 
                       class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('cargos.destroy', $cargo) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Eliminar este cargo?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <p class="text-muted fs-4">No hay cargos registrados</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación igual -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $cargos->links() }}
    </div>
</div>
@endsection