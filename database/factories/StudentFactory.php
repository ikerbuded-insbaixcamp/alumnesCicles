<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Cicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date('Y-m-d'),
            'phone_number' => $this->faker->phoneNumber(),
            'cicle_id' => null,
        ];
    }

    public function withCicle()
    {
        return $this->state(fn() => [
            'cicle_id' => Cicle::factory(),
        ]);
    }
}
