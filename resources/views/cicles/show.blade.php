@extends('layouts.plantilla')

@section('titol', 'VISTA DETALL CICLE')

@section('contingut')
    <div class="row mt-4">
        <div class="col-sm-4">
            <img src="{{ asset('storage/'.$cicle->image) }}" alt="{{$cicle->name}}" class="img-fluid">
        </div>
        <div class="col-sm-8 d-flex flex-column justify-content-between">
            <div>
                <h1>{{$cicle->name}}</h1>
                <h2>{{$cicle->code}}</h2>
                <h4>Cursos: {{$cicle->num_courses}}</h4>
            </div>
            
            <p><strong>Descripció: </strong> {{$cicle->description}}</p>
            @auth
                @if (Auth::user()->email === 'admin@admin.cat')
                <a href="{{ route('cicles.edit', ['id' => $cicle->id]) }}" class="btn btn-warning bi bi-pencil-fill"></a>
                <a href="{{ route('cicles.delete', ['id' => $cicle->id]) }}" class="btn btn-danger bi bi-trash-fill"></a>  
                @else
                @if (Auth::user()->student && Auth::user()->student->cicle_id === null)
                    <a href="{{ route('student.assignarCicle', ['id' => $cicle->id]) }}" class="btn btn-primary">Apuntar-se al cicle</a>
                    @else
                    <a href="{{ route('student.desAssignarCicle')}}" class="btn btn-warning">Desapuntar-se del cicle</a>
                    @endif
                @endif
            @endauth
            <a href="{{ route('dashboard') }}" class="btn btn-light bi bi-caret-left-fill"> Tornar al llistat </a>
        </div>
    </div>
@endsection