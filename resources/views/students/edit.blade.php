@extends('layouts.plantilla')

@section('titol', 'Editar Alumne')

@section('contingut')
<div class="container mt-3">
    <h2>Editar l'alumne: {{$alumne->name}}</h2>

    <form action="{{ route('students.update', $alumne->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label mt-4">Nom:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $alumne->name) }}" 
                class="form-control @error('name') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('name')) is-valid @endif"
                placeholder="Nom de l'alumne">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('name', $alumne->name))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label mt-4">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $alumne->email) }}" 
                class="form-control @error('email') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('email')) is-valid @endif"
                placeholder="Correu electrònic">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('email', $alumne->email))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label mt-4">Adreça:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $alumne->address) }}" 
                class="form-control @error('address') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('address')) is-valid @endif"
                placeholder="Adreça de l'alumne">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('address', $alumne->address))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label mt-4">Data de Naixement:</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $alumne->birth_date) }}" 
                class="form-control @error('birth_date') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('birth_date')) is-valid @endif">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('birth_date', $alumne->birth_date))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label mt-4">Telèfon:</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $alumne->phone_number) }}" 
                class="form-control @error('phone_number') is-invalid @enderror @if(session()->getOldInput() && !$errors->has('phone_number')) is-valid @endif"
                placeholder="Telèfon de l'alumne">
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('phone_number', $alumne->phone_number))
                <div class="valid-feedback">Correcte!</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cicle" class="form-label mt-4">Cicle:</label>
            <select name="cicle" id="cicle" class="form-control">
                <option value="" selected>Sense Cicle</option>
                @foreach ($cicles as $cicle)
                    <option value="{{ $cicle->id }}" 
                        @if(old('cicle', $alumne->cicle_id) == $cicle->id) selected @endif>
                        {{ $cicle->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualitzar Alumne</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Tornar</a>
    </form>
</div>
@endsection
