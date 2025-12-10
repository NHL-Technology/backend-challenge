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
        // Usar with('author') para eager loading
        // Retornar JSON con estructura:
        // {
        //   "success": true,
        //   "data": [...]
        // }
    }

    /**
     * GET /api/books/{id}
     * Mostrar detalle de un libro específico
     */
    public function show($id)
    {
        // TODO: Buscar el libro por ID
        // Incluir autor y préstamos (with(['author', 'loans']))
        // Si no existe, retornar 404
        // Si existe, retornar JSON con el libro
    }

    /**
     * POST /api/loans
     * Crear un nuevo préstamo
     */
    public function store(Request $request)
    {
        // TODO: Validar los datos recibidos
        // - book_id: required, exists:books,id
        // - user_name: required, string, max:255
        // - loan_date: required, date

        // TODO: Buscar el libro

        // TODO: Verificar si el libro está disponible
        // Si NO está disponible, retornar error 400:
        // {
        //   "success": false,
        //   "message": "El libro no está disponible para préstamo"
        // }

        // TODO: Si está disponible:
        // 1. Crear el préstamo con status 'active'
        // 2. Actualizar el libro a available = false
        // 3. Retornar response 201 con el préstamo creado
    }
}