@extends('layouts.app')

@section('title', 'Empleados')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados-index.css') }}?v={{ time() }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/empleados-index.js') }}?v={{ time() }}"></script>
@endpush

@section('content')
<div class="container-fluid py-4">

    <!-- Cabecera idéntica a la de Cargos -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h1 class="h3 mb-0">Lista de Empleados</h1>

        <div class="d-flex gap-2 flex-wrap">
            <input type="text" id="search" class="form-control form-control-lg rounded-pill ps-5" 
                   placeholder="Buscar empleado..." autocomplete="off">
            <a href="{{ route('empleados.create') }}" class="btn btn-success btn-lg rounded-pill shadow-sm">
                + Nuevo empleado
            </a>
        </div>
    </div>

    <!-- MISMA ESTRUCTURA QUE CARGOS → mismo diseño automático -->
    <div class="empleados-list">
        @forelse($empleados as $empleado)
            <div class="empleado-item">
                <!-- Avatar igual que en Cargos -->
                <div class="empleado-avatar">
                    {{ substr($empleado->nombres, 0, 1) }}{{ substr($empleado->apellidos, 0, 1) }}
                </div>

                <div class="empleado-info">
                    <h5 class="mb-1 fw-bold">{{ $empleado->nombres }} {{ $empleado->apellidos }}</h5>
                    <small class="text-muted">{{ $empleado->identificacion }}</small>

                    <div class="mt-2">
                        @foreach($empleado->cargos as $cargo)
                            <span class="badge bg-primary me-1">{{ $cargo->nombre }}</span>
                        @endforeach
                    </div>

                    <div class="mt-2 text-muted small">
                        Jefe: 
                        <strong class="text-primary">
                            {{ $empleado->jefe ? $empleado->jefe->nombres.' '.$empleado->jefe->apellidos : 'Sin jefe' }}
                        </strong>
                    </div>
                </div>

                <div class="empleado-acciones">
                    <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este empleado?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <p class="text-muted fs-4">No hay empleados registrados</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $empleados->links() }}
    </div>
</div>
@endsection