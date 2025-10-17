<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Communities;
use App\Livewire\Parishioners;
use App\Livewire\Priests;
use App\Livewire\SacramentTypes;
use App\Livewire\AssignedSacraments;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/communities', Communities::class);
    Route::get('/parishioners', Parishioners::class);
    Route::get('/priests', Priests::class);
    Route::get('/sacrament-types', SacramentTypes::class);
    Route::get('/assigned-sacraments', AssignedSacraments::class);
});
