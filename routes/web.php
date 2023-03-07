<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Models\Cliente;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'clientes' => Cliente::get()
       
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('clientes', ClienteController::class); 
    Route::resource('servicios', ServicioController::class); 

    Route::get('view/cliente/{cliente}', function (Cliente $cliente){
        
        $servicios = $cliente->servicios;

        return inertia('View', [
            'cliente' => $cliente,
            'servicios' => $servicios,
        ]);
    })->name('viewcliente');
});
