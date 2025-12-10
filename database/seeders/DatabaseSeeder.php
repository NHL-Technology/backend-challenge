<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Loan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TODO: Crear 3 autores
        // Ejemplo:
        // $author1 = Author::create([
        //     'name' => 'Gabriel García Márquez',
        //     'country' => 'Colombia'
        // ]);

        // TODO: Crear 10 libros asignados a diferentes autores
        // Algunos con available = true, otros con available = false
        // Ejemplo:
        // Book::create([
        //     'title' => 'Cien años de soledad',
        //     'author_id' => $author1->id,
        //     'isbn' => '978-0307474728',
        //     'published_year' => 1967,
        //     'available' => true
        // ]);

        // TODO: Crear 5 préstamos
        // 3 activos (status 'active', sin return_date)
        // 2 devueltos (status 'returned', con return_date)
        // Los préstamos activos deben corresponder a libros con available = false
        // Ejemplo:
        // Loan::create([
        //     'book_id' => 1,
        //     'user_name' => 'Juan Pérez',
        //     'loan_date' => '2024-12-01',
        //     'return_date' => null,
        //     'status' => 'active'
        // ]);
    }
}