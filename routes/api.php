<?php

use App\Http\Controllers\Owners\Destroy as OwnerDestroy;
use App\Http\Controllers\Owners\Index as OwnerIndex;
use App\Http\Controllers\Owners\Show as OwnerShow;
use App\Http\Controllers\Owners\Store as OwnerStore;
use App\Http\Controllers\Owners\Update as OwnerUpdate;
use App\Http\Controllers\Pets\Destroy as PetDestroy;
use App\Http\Controllers\Pets\Index as PetIndex;
use App\Http\Controllers\Pets\Show as PetShow;
use App\Http\Controllers\Pets\Store as PetStore;
use App\Http\Controllers\Pets\Update as PetUpdate;
use App\Http\Controllers\PetTypes\Index as PetTypeIndex;
use App\Http\Controllers\Users\Destroy as UserDestroy;
use App\Http\Controllers\Users\Index as UserIndex;
use App\Http\Controllers\Users\Show as UserShow;
use App\Http\Controllers\Users\Store as UserStore;
use App\Http\Controllers\Users\Update as UserUpdate;
use Illuminate\Support\Facades\Route;

Route::get('/pet-types', PetTypeIndex::class);

Route::delete('/pets/{pet}', PetDestroy::class);
Route::get('/pets', PetIndex::class);
Route::get('/pets/{pet}', PetShow::class);
Route::post('/pets', PetStore::class);
Route::put('/pets/{pet}', PetUpdate::class);

Route::delete('/owners/{owner}', OwnerDestroy::class);
Route::get('/owners', OwnerIndex::class);
Route::get('/owners/{owner}', OwnerShow::class);
Route::post('/owners', OwnerStore::class);
Route::put('/owners/{owner}', OwnerUpdate::class);

Route::delete('/users/{user}', UserDestroy::class);
Route::get('/users', UserIndex::class);
Route::get('/users/{user}', UserShow::class);
Route::post('/users', UserStore::class);
Route::put('/users/{user}', UserUpdate::class);
