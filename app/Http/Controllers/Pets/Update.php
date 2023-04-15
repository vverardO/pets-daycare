<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pets\UpdatePetRequest;
use App\Http\Resources\Pets\PetResource;
use App\Models\Pet;
use Illuminate\Http\Resources\Json\JsonResource;

class Update extends Controller
{
    public function __invoke(UpdatePetRequest $request, Pet $pet): JsonResource
    {
        $pet->update($request->validated());

        return new PetResource($pet);
    }
}
