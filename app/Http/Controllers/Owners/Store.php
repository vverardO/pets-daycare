<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owners\StoreOwnerRequest;
use App\Http\Resources\Owners\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Resources\Json\JsonResource;

class Store extends Controller
{
    public function __invoke(StoreOwnerRequest $request): JsonResource
    {
        $owner = new Owner();
        $owner->fill($request->validated());
        $owner->save();

        return new OwnerResource($owner);
    }
}
