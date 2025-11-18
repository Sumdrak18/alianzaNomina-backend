@extends('layouts.app')

@section('content')
<h2>Editar Cargo</h2>

{{-- MENSAJES DE ERROR --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('cargos.update', $cargo) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del cargo *</label>
        <input type="text" name="nombre" class="form-control"
               value="{{ $cargo->nombre }}" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('cargos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
