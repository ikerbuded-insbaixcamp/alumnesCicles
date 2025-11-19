@extends('layouts.plantilla')

@section('titol', 'INICI')

@section('contingut')
<div class="container mt-4">
    @if (Auth::user()->email === 'admin@admin.cat') <!-- Comprobamos si el usuario es admin -->
    <!-- Sección de Cicles Disponibles para Admin -->
        <h3 class="mb-4 text-center">Cicles Disponibles</h3>
        <div class="row">
            @foreach ($cicles as $cicle)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('storage/'.$cicle->image) }}" class="card-img-top" alt="{{ $cicle->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $cicle->name }}</h5>
                            <div class="d-grid gap-1">
                                <a href="{{ route('cicles.show', $cicle->id) }}" class="btn btn-primary mb-1">Veure més</a>
                                <a href="{{ route('cicles.edit', $cicle->id) }}" class="btn btn-warning mb-1">Editar</a>
                                <a href="{{ route('cicles.delete', $cicle->id) }}" class="btn btn-danger mb-1">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sección de Llista d'Estudiants para Admin -->
        <h2 class="mb-4 text-center">Llista d'Estudiants</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Cicle</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnes as $alumne)
                        <tr>
                            <td>{{ $alumne->name }}</td>
                            <td>{{ $alumne->email }}</td>
                            <td>
                                @if ($alumne->cicle)
                                    <span class="badge bg-primary">{{ $alumne->cicle->name }}</span>
                                @else
                                    <span class="badge bg-secondary">No té cicle assignat</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.show', ['id' => $alumne->id]) }}" class="btn btn-info btn-sm bi bi-eye-fill" title="Veure"></a>
                                <a href="{{ route('students.edit', ['id' => $alumne->id]) }}" class="btn btn-warning btn-sm bi bi-pencil-fill" title="Editar"></a>
                                <!-- Botó per obrir el modal -->
                                <button class="btn btn-danger btn-sm bi bi-trash-fill btn-eliminar" 
                                    data-id="{{ $alumne->id }}" 
                                    data-name="{{ $alumne->name }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEliminar" title="Eliminar"></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $alumnes->links() }}
            </div>
        </div>

    @else
        <!-- Sección para Estudiant -->
        <h3>Les Teves Dades</h3>
        <p><strong>Nom:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Correu electrònic:</strong> {{ auth()->user()->email }}</p>

        @if (Auth::user()->student && Auth::user()->student->cicle_id !== null)
            <h3>Cicle Assignat</h3>
            <div class="card width-50">
                <img src="{{ asset('storage/'.auth()->user()->student->cicle->image) }}" class="card-img-top" alt="{{ auth()->user()->student->cicle->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ auth()->user()->student->cicle->name }}</h5>
                    <p class="card-text">{{ auth()->user()->student->cicle->description }}</p>
                    <a href="{{ route('cicles.show', auth()->user()->student->cicle->id) }}" class="btn btn-primary">Veure més</a>
                </div>
            </div>
        @else
            <!-- Mostrar cicles disponibles si no tiene cicle asignat -->
            <h3>Cicles Disponibles</h3>
            <div class="row">
                @foreach ($cicles as $cicle)
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="{{ asset('storage/' . $cicle->image) }}" class="card-img-top" alt="{{ $cicle->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cicle->name }}</h5>
                                <p class="card-text">{{ $cicle->description }}</p>
                                <a href="{{ route('cicles.show', $cicle->id) }}" class="btn btn-primary">Veure més</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    @endif
</div>

<!-- MODAL GLOBAL (actualitzem el contingut amb JavaScript) -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Eliminar Alumne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Estàs segur que vols eliminar l'alumne: <strong id="modalStudentName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tancar</button>
                <a href="#" id="modalDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript per actualitzar el modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalEliminar = document.getElementById("modalEliminar");
        const modalStudentName = document.getElementById("modalStudentName");
        const modalDeleteButton = document.getElementById("modalDeleteButton");

        document.querySelectorAll(".btn-eliminar").forEach(button => {
            button.addEventListener("click", function() {
                const studentId = this.getAttribute("data-id");
                const studentName = this.getAttribute("data-name");

                modalStudentName.textContent = studentName;
                modalDeleteButton.href = `/students/delete/${studentId}`;
            });
        });
    });
</script>
@endsection
