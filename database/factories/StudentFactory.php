<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Programme;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber,
            'dob' => $this->faker->date(),

            //cleaning version 1
            // Use existing programme/batch or create new ones
            // 'programme_id' => Programme::inRandomOrder()->value('id') ?? Programme::factory()->create()->id,
            // 'batch_id' => Batch::inRandomOrder()->value('id') ?? Batch::factory()->create()->id,
        ];
    }
}
