@extends('layouts.plantilla')

@section('titol', 'Detalls de l\'Estudiant')

@section('contingut')
<div class="container mt-4">
    <h2>Detalls de l'Estudiant</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $alumne->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $alumne->email }}</p>
            <p class="card-text"><strong>Adreça:</strong> {{ $alumne->address }}</p>
            <p class="card-text"><strong>Telèfon:</strong> {{ $alumne->phone_number }}</p>
            <p class="card-text"><strong>Data de naixement:</strong> {{ $alumne->birth_date }}</p>
            
            <p class="card-text"><strong>Cicle:</strong> 
                @if ($alumne->cicle)
                    {{ $alumne->cicle->name }}
                @else
                    Sense cicle assignat
                @endif
            </p>

            <a href="{{ route('dashboard') }}" class="btn btn-light">Tornar</a>
            <a href="{{ route('students.edit', ['id' => $alumne->id]) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('students.delete', ['id' => $alumne->id]) }}" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
</div>
@endsection
