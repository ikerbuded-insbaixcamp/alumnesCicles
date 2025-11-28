<?php

namespace Database\Factories;

use App\Models\Cicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CicleFactory extends Factory
{
    protected $model = Cicle::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'num_courses' => $this->faker->numberBetween(1, 5),
            'image' => 'default.jpg',
        ];
    }
}
