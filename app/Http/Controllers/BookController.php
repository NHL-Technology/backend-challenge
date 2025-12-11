<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * GET /api/books
     * Listar todos los libros con información del autor
     */
    public function index()
    {
        // TODO: Obtener todos los libros con sus autores
        // Retornar JSON: { "success": true, "data": [...] }
    }

    /**
     * GET /api/books/{id}
     * Mostrar detalle de un libro específico
     */
    public function show($id)
    {
        // TODO: Buscar el libro por ID incluyendo autor y préstamos
        // Retornar 404 si no existe
    }

    /**
     * POST /api/loans
     * Crear un nuevo préstamo
     */
    public function store(Request $request)
    {
        // TODO: Validar los datos recibidos (book_id, user_name, loan_date)

        // TODO: Verificar disponibilidad del libro
        // Si no está disponible, retornar error 400

        // TODO: Crear el préstamo y actualizar disponibilidad del libro
        // Retornar response 201
    }
}