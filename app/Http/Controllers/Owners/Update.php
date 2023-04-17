<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owners\UpdateOwnerRequest;
use App\Http\Resources\Owners\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Resources\Json\JsonResource;

class Update extends Controller
{
    public function __invoke(UpdateOwnerRequest $request, Owner $owner): JsonResource
    {
        $owner->update($request->validated());

        return new OwnerResource($owner);
    }
}
