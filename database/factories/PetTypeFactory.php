<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
        ];
    }
}
