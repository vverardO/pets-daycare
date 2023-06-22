<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResourceCollection;
use App\Models\User;

class Index extends Controller
{
    public function __invoke()
    {
        return new UserResourceCollection(
            User::paginate()
        );
    }
}
