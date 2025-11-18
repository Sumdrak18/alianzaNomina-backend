@extends('layouts.app')

@section('content')
<h1>Lista de Empleados</h1>

<a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Crear Empleado</a>

<table class="table table-bordered">
    <tr>
        <th>Nombre</th>
        <th>Identificación</th>
        <th>Cargos</th>
        <th>Jefe</th>
        <th>Acciones</th>
    </tr>

    @foreach($empleados as $empleado)
    <tr>
        <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
        <td>{{ $empleado->identificacion }}</td>
        <td>
            @foreach($empleado->cargos as $cargo)
                <span class="badge bg-info">{{ $cargo->nombre }}</span>
            @endforeach
        </td>
        <td>{{ $empleado->jefe ? $empleado->jefe->nombres : 'N/A' }}</td>
        <td>
            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">Editar</a>

            <form action="{{ route('empleados.destroy', $empleado) }}"
                method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

{{ $empleados->links() }}

@endsection
