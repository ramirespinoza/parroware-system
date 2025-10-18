<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

use Illuminate\Support\Facades\Route;
use App\Livewire\Communities;
use App\Livewire\Parishioners;
use App\Livewire\Priests;
use App\Livewire\SacramentTypes;
use App\Livewire\AssignedSacraments;
use App\Livewire\Certificates;
use App\Livewire\ServiceTypes;
use App\Livewire\Pays;

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

    Route::get('/communities', Communities::class)->name('communities');
    Route::get('/parishioners', Parishioners::class)->name('parishioners');
    Route::get('/priests', Priests::class)->name('priests');
    Route::get('/sacrament-types', SacramentTypes::class)->name('sacrament-types');
    Route::get('/assigned-sacraments', AssignedSacraments::class)->name('assigned-sacraments');
    Route::get('/certificates', Certificates::class)->name('certificates');
    Route::get('/service-types', ServiceTypes::class)->name('service-types');
    Route::get('/pays', Pays::class)->name('pays');
    Route::get('users/export/', [Parishioners::class, 'export'])->name('parishioners-export');
    Route::get('/admin/register', function () {
        // Solo el admin puede ver la vista
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Solo el administrador puede registrar nuevos usuarios.');
        }

        return view('auth.register');
    })->name('admin.register');
    Route::post('/admin/register', function (Request $request) {
        // Solo el admin puede crear usuarios
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Solo el administrador puede registrar nuevos usuarios.');
        }

        $action = new CreateNewUser();
        $action->create($request->all());

        return redirect()->route('dashboard')->with('success', 'Usuario creado correctamente.');
    })->name('register');
});