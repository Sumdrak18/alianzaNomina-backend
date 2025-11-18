@extends('layouts.app')

@section('content')
<h2>Listado de Cargos</h2>

<a href="{{ route('cargos.create') }}" class="btn btn-primary mb-3">Nuevo Cargo</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($cargos as $cargo)
        <tr>
            <td>{{ $cargo->id }}</td>
            <td>{{ $cargo->nombre }}</td>
            <td>
                <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('cargos.destroy', $cargo) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $cargos->links() }}

@endsection
