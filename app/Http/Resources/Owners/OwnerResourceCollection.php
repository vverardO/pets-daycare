<?php

namespace App\Http\Resources\Owners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OwnerResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['data' => $this->collection];
    }
}
