<?php

namespace App\Http\Resources\Pets;

use App\Http\Resources\PetTypes\PetTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'pet_type_id' => $this->pet_type_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'deleted_at' => $this->deleted_at?->format('d/m/Y'),
            'petType' => PetTypeResource::make($this->whenLoaded('petType')),
        ];
    }
}
