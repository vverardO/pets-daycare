<?php

namespace App\Http\Resources\Pets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PetResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['data' => $this->collection];
    }
}
