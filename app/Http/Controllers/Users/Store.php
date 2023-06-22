<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Store extends Controller
{
    public function __invoke(StoreUserRequest $request): JsonResource
    {
        $user = new User();
        $user->fill($request->validated());
        $user->save();

        return new UserResource($user);
    }
}
