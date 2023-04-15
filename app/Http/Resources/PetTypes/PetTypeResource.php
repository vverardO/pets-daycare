<?php

namespace App\Http\Resources\PetTypes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'deleted_at' => $this->deleted_at?->format('d/m/Y'),
        ];
    }
}
