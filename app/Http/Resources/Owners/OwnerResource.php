<?php

namespace App\Http\Resources\Owners;

use App\Http\Resources\Pets\PetResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'general_record' => $this->general_record,
            'registration_physical_person' => $this->registration_physical_person,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'pets' => PetResource::collection($this->whenLoaded('pets')),
        ];
    }
}
