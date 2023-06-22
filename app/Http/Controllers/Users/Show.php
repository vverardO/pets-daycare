<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource as UsersUserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Show extends Controller
{
    public function __invoke(User $user): JsonResource
    {
        return new UsersUserResource($user);
    }
}
