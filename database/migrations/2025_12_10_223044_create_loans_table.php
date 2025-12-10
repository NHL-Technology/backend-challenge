<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            
            // TODO: Agregar las siguientes columnas:
            // - book_id (unsignedBigInteger, foreign key a books)
            // - user_name (string)
            // - loan_date (date)
            // - return_date (date, nullable)
            // - status (string: 'active' o 'returned')
            
            $table->timestamps();

            // TODO: Definir la foreign key constraint
            // Debe referenciar la tabla 'books' y tener onDelete('cascade')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};