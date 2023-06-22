<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Update extends Controller
{
    public function __invoke(UpdateUserRequest $request, User $user): JsonResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }
}
