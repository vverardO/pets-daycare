<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pets\PetResourceCollection;
use App\Models\Pet;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Index extends Controller
{
    public function __invoke(): ResourceCollection
    {
        return new PetResourceCollection(
            Pet::with(['petType'])->paginate()
        );
    }
}
