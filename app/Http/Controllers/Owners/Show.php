<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Http\Resources\Owners\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Resources\Json\JsonResource;

class Show extends Controller
{
    public function __invoke(Owner $owner): JsonResource
    {
        return new OwnerResource($owner);
    }
}
