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

        // TODO: Crear 10 libros asignados a diferentes autores (variar disponibilidad)

        // TODO: Crear 5 préstamos (3 activos, 2 devueltos)
        // Los préstamos activos deben corresponder a libros no disponibles
    }
}