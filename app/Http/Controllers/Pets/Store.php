<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pets\StorePetRequest;
use App\Http\Resources\Pets\PetResource;
use App\Models\Pet;
use Illuminate\Http\Resources\Json\JsonResource;

class Store extends Controller
{
    public function __invoke(StorePetRequest $request): JsonResource
    {
        $pet = new Pet();
        $pet->fill($request->validated());
        $pet->save();

        return new PetResource($pet);
    }
}
