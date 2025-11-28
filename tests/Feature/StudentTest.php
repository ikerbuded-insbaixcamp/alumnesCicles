<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Cicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_es_pot_veure_un_estudiant()
    {
        $student = Student::factory()->create();
        $user = User::find($student->user_id);

        $response = $this->actingAs($user)
            ->get(route('students.show', $student->id));

        $response->assertStatus(200);
        $response->assertSee($student->name);
        $response->assertSee($student->email);
    }

    public function test_es_pot_assignar_un_cicle()
    {
        $cicle = Cicle::factory()->create();

        // estudiante sin ciclo → fábrica por defecto
        $student = Student::factory()->create([
            'cicle_id' => null
        ]);

        $user = User::find($student->user_id);

        $this->actingAs($user)
            ->get(route('student.assignarCicle', $cicle->id));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'cicle_id' => $cicle->id
        ]);
    }

    public function test_es_pot_desassignar_un_cicle()
    {
        // estudiante con ciclo asignado
        $cicle = Cicle::factory()->create();

        $student = Student::factory()->create([
            'cicle_id' => $cicle->id
        ]);

        $user = User::find($student->user_id);

        $this->actingAs($user)
            ->get(route('student.desAssignarCicle'));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'cicle_id' => null
        ]);
    }
}
