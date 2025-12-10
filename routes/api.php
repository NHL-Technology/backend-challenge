<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: Descomentar y/o agregar las siguientes rutas

// Listar todos los libros
// Route::get('/books', [BookController::class, 'index']);

// Mostrar detalle de un libro
// Route::get('/books/{id}', [BookController::class, 'show']);

// Crear un nuevo préstamo
// Route::post('/loans', [BookController::class, 'store']);