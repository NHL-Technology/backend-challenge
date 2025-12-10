<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'isbn',
        'published_year',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    /**
     * TODO: Definir la relación con Author
     * Un libro pertenece a un autor (belongsTo)
     */
    // public function author()
    // {
    //     
    // }

    /**
     * TODO: Definir la relación con Loan
     * Un libro puede tener muchos préstamos (hasMany)
     */
    // public function loans()
    // {
    //     
    // }
}