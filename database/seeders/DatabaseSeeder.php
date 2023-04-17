<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Owner::factory(30)->create();
        Pet::factory(50)->create();
    }
}
