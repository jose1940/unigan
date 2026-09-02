<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\RegistroMedicoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes - UNIGAN
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::view('/', 'welcome');

// Contacto
Route::view('/contacto', 'contacto');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Perfil
    Route::view('/profile', 'profile')->name('profile');

    // Animales
    Route::resource('animales', AnimalController::class);

    // Inventario
    Route::resource('inventario', InventarioController::class);

    // Registros Médicos
    Route::resource('registros-medicos', RegistroMedicoController::class);

    // Usuarios
    Route::resource('usuarios', UsuarioController::class);

});

require __DIR__.'/auth.php';