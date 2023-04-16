<?php

namespace App\Http\Resources\PetTypes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PetTypeResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['data' => $this->collection];
    }
}
