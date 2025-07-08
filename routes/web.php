<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\HabitoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $user = Auth::user();
    if ($user) {
        return redirect('habitos');     
    }
    return view('user.notAuthenticated.home', [
        'user' => $user
    ]);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('habitos', HabitoController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('alimentos', AlimentoController::class);