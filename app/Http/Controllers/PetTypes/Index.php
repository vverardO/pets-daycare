<?php

namespace App\Http\Controllers\PetTypes;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetTypes\PetTypeResourceCollection;
use App\Models\PetType;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Index extends Controller
{
    public function __invoke(): ResourceCollection
    {
        return new PetTypeResourceCollection(
            PetType::all()
        );
    }
}
