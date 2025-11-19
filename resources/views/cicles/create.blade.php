@extends('layouts.plantilla')

@section('titol', 'CREAR CICLE')

@section('contingut')
<div class="container mt-3">
    <h2>Crear Cicle</h2>

    <form action="{{ route('cicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label mt-4">Codi:</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}" 
                class="form-control @error('code') is-invalid @enderror @if(old('code') && !$errors->has('code')) is-valid @endif"
                placeholder="DAW">
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('code'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label mt-4">Nom:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                class="form-control @error('name') is-invalid @enderror @if(old('name') && !$errors->has('name')) is-valid @endif"
                placeholder="Desenvolupament d’Aplicacions Web">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('name'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label mt-4">Descripció: </label>
            <input type="text" id="description" name="description" value="{{ old('description') }}" 
                class="form-control @error('description') is-invalid @enderror @if(old('description') && !$errors->has('description')) is-valid @endif"
                placeholder="Desenvolupament d’Aplicacions Web">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('description'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="num_courses" class="form-label mt-4">Número de cursos: </label>
            <input type="number" id="num_courses" name="num_courses" value="{{ old('num_courses') }}" 
                class="form-control @error('num_courses') is-invalid @enderror @if(old('num_courses') && !$errors->has('num_courses')) is-valid @endif"
                placeholder="2">
            @error('num_courses')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('num_courses'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label mt-4">Imatge: </label>
            <input type="file" id="image" name="image"
            class="form-control @error('image') is-invalid @enderror @if(old('image') && !$errors->has('image')) is-valid @endif">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('image'))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Afegir Cicle</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Tornar</a>
        </div>
    </form>
</div>
@endsection
