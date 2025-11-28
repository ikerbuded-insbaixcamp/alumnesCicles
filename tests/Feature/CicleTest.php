<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cicle;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_es_pot_crear_un_cicle()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('cicles.store'), [
            'code' => 'DAW',
            'name' => 'Desenvolupament Aplicacions Web',
            'description' => 'Cicle de desenvolupament d’aplicacions web amb Laravel i JS',
            'num_courses' => 2,
            'image' => UploadedFile::fake()->create('daw.jpg', 100), // ← aquí no depende de GD
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('cicles', [
            'code' => 'DAW',
            'name' => 'Desenvolupament Aplicacions Web'
        ]);
    }

    public function test_es_pot_eliminar_un_cicle()
    {
        $user = User::factory()->create();
        $cicle = Cicle::factory()->create();

        $this->actingAs($user)
            ->get(route('cicles.delete', $cicle->id));

        $this->assertDatabaseMissing('cicles', [
            'id' => $cicle->id
        ]);
    }
}
