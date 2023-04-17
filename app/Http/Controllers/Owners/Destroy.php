<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Response;

class Destroy extends Controller
{
    public function __invoke(Owner $owner): Response
    {
        $owner->delete();

        return response()->noContent();
    }
}
