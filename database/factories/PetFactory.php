<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\PetType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'description' => fake()->paragraph(4),
            'pet_type_id' => PetType::inRandomOrder()->first()->id,
            'owner_id' => Owner::inRandomOrder()->first()->id,
        ];
    }
}
