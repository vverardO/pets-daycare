<?php

use App\Http\Controllers\Pets\Destroy as PetDestroy;
use App\Http\Controllers\Pets\Index as PetIndex;
use App\Http\Controllers\Pets\Show as PetShow;
use App\Http\Controllers\Pets\Store as PetStore;
use App\Http\Controllers\Pets\Update as PetUpdate;
use App\Http\Controllers\PetTypes\Index as PetTypeIndex;
use Illuminate\Support\Facades\Route;

Route::get('/pet-types', PetTypeIndex::class);

Route::delete('/pets/{pet}', PetDestroy::class);
Route::get('/pets', PetIndex::class);
Route::get('/pets/{pet}', PetShow::class);
Route::post('/pets', PetStore::class);
Route::put('/pets/{pet}', PetUpdate::class);
