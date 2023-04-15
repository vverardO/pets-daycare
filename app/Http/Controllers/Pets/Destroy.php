<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Response;

class Destroy extends Controller
{
    public function __invoke(Pet $pet): Response
    {
        $pet->delete();

        return response()->noContent();
    }
}
