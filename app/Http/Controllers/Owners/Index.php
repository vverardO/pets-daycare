<?php

namespace App\Http\Controllers\Owners;

use App\Http\Controllers\Controller;
use App\Http\Resources\Owners\OwnerResourceCollection;
use App\Models\Owner;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Index extends Controller
{
    public function __invoke(): ResourceCollection
    {
        return new OwnerResourceCollection(
            Owner::with(['pets'])->paginate()
        );
    }
}
