<?php

namespace Database\Factories;

use App\Enums\GendersEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    public function definition(): array
    {
        $gender = fake()->boolean() ? GendersEnum::Male : GendersEnum::Female;

        [
            $one,
            $two,
            $three,
            $four,
        ] = [
            substr(str_shuffle('0123456789'), 0, 3),
            substr(str_shuffle('0123456789'), 0, 3),
            substr(str_shuffle('0123456789'), 0, 3),
            substr(str_shuffle('0123456789'), 0, 2),
        ];

        $document = str_shuffle('0123456789');

        return [
            'name' => fake()->unique()->firstName(),
            'gender' => $gender,
            'general_record' => $document,
            'birth_date' => fake()->date(),
            'registration_physical_person' => "$one$two$three$four",
        ];
    }
}
