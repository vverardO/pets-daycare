<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pets\PetResource;
use App\Models\Pet;
use Illuminate\Http\Resources\Json\JsonResource;

class Show extends Controller
{
    public function __invoke(Pet $pet): JsonResource
    {
        return new PetResource($pet);
    }
}
