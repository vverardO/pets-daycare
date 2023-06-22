<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class Destroy extends Controller
{
    public function __invoke(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
