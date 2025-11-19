@extends('layouts.plantilla')

@section('titol', 'EDITAR CICLE')

@section('contingut')
<div class="container mt-4">
    <h2>Editar el cicle: {{$cicle->name}}</h2>

    <form action="{{ route('cicles.update', $cicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code" class="form-label mt-4">Codi:</label>
            <input type="text" id="code" name="code" value="{{ old('code', $cicle->code) }}" 
                class="form-control @error('code') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('code')) is-valid @endif"
                placeholder="DAW">
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('code', $cicle->code))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label mt-4">Nom:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $cicle->name) }}" 
                class="form-control @error('name') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('name')) is-valid @endif"
                placeholder="Desenvolupament d\’Aplicacions Web">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('name', $cicle->name))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label mt-4">Descripció: </label>
            <input type="text" id="description" name="description" value="{{ old('description', $cicle->description) }}" 
                class="form-control @error('description') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('description')) is-valid @endif"
                placeholder="Desenvolupament d\’Aplicacions Web">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('description', $cicle->description))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="num_courses" class="form-label mt-4">Número de cursos: </label>
            <input type="number" id="num_courses" name="num_courses" value="{{ old('num_courses', $cicle->num_courses) }}" 
                class="form-control @error('num_courses') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('num_courses')) is-valid @endif"
                placeholder="2">
            @error('num_courses', $cicle->num_courses)
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('num_courses'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label mt-4">Imatge:</label>
        
            @if ($cicle->image)
                <div class="mb-2">
                    <p class="mb-1">Imatge actual:</p>
                    <img src="{{ asset('storage/'.$cicle->image) }}" alt="Imatge actual" style="max-height: 150px;">
                </div>
            @endif
        
            <input type="file" id="image" name="image"
                class="form-control @error('image') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('image')) is-valid @endif">
        
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('image'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar Cicle</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Tornar</a>
    </form>
</div>
@endsection
