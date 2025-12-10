# Backend Challenge - API de Biblioteca

**Tiempo límite:** 30 minutos
**Tecnologías:** PHP Laravel, Eloquent ORM, SQLite/MySQL

## Contexto

El desafío consiste en completar una API REST para un sistema de gestión de una biblioteca digital. El proyecto ya incluye la estructura base de Laravel, los modelos iniciales y algunas migraciones, pero se requieren implementaciones clave para completar el backend.

## Objetivo

El objetivo principal es completar la API para que sea capaz de:

* Gestionar libros y autores, incluyendo sus relaciones.
* Registrar préstamos de libros.
* Validar que un libro esté disponible antes de prestarlo.
* Proveer endpoints REST para consultar la información de los libros y los préstamos.

## Setup Inicial

Para configurar el entorno de desarrollo, sigue estos pasos:

```bash
# Navega a la carpeta del desafío
cd backend-challenge

# Instala las dependencias del proyecto
composer install

# Copia el archivo de configuración
cp .env.example .env

# Genera la clave de la aplicación
php artisan key:generate

# Crea la base de datos (SQLite)
touch database/database.sqlite

# Ejecuta las migraciones
php artisan migrate

# Ejecuta los seeders (una vez que estén completados)
php artisan db:seed

# Inicia el servidor de desarrollo
php artisan serve

# La API estará disponible en http://localhost:8000
```

## Tareas a Completar

### Tarea 1: Completar migración y relaciones (10 min)

#### Archivo: `database/migrations/xxxx_create_loans_table.php`

**Requisitos:**

* Agregar las siguientes columnas a la tabla `loans`:

  * `book_id` (unsignedBigInteger, foreign key a books)
  * `user_name` (string)
  * `loan_date` (date)
  * `return_date` (date, nullable)
  * `status` (string: 'active', 'returned')

* Definir la foreign key constraint con `onDelete('cascade')`

#### Archivos de Modelos:

* `app/Models/Book.php`
* `app/Models/Author.php`
* `app/Models/Loan.php`

**Requisitos:**

* **Book:** Definir la relación `belongsTo` con `Author`.
* **Book:** Definir la relación `hasMany` con `Loan`.
* **Author:** Definir la relación `hasMany` con `Book`.
* **Loan:** Definir la relación `belongsTo` con `Book`.

**Ejemplo de relación esperada:**

```php
public function author()
{
    return $this->belongsTo(Author::class);
}
```

---

### Tarea 2: Crear seeder con datos de prueba (8 min)

#### Archivo: `database/seeders/DatabaseSeeder.php`

**Requisitos:**

* Crear **3 autores** con datos realistas.
* Crear **10 libros** asignados a diferentes autores:

  * Algunos libros con `available = true`.
  * Algunos libros con `available = false`.
* Crear **5 préstamos**:

  * 3 con el estado 'active' (sin `return_date`).
  * 2 con el estado 'returned' (con `return_date`).
  * Los préstamos activos deben corresponder a libros con `available = false`.

**Estructura de datos esperada:**

```php
// Autores
['name' => 'Gabriel García Márquez', 'country' => 'Colombia']
['name' => 'Isabel Allende', 'country' => 'Chile']
['name' => 'Jorge Luis Borges', 'country' => 'Argentina']

// Libros (ejemplos)
[
    'title' => 'Cien años de soledad',
    'author_id' => 1,
    'isbn' => '978-0307474728',
    'published_year' => 1967,
    'available' => true
]
```

---

### Tarea 3: Implementar endpoints API (12 min)

#### Archivo: `app/Http/Controllers/BookController.php`

#### Endpoint 1: GET /api/books

**Requisitos:**

* Listar todos los libros.
* Incluir la información del autor (usar `with('author')`).
* Retornar un JSON con la siguiente estructura:

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Cien años de soledad",
      "isbn": "978-0307474728",
      "published_year": 1967,
      "available": true,
      "author": {
        "id": 1,
        "name": "Gabriel García Márquez",
        "country": "Colombia"
      }
    }
  ]
}
```

#### Endpoint 2: GET /api/books/{id}

**Requisitos:**

* Mostrar el detalle de un libro específico.
* Incluir la información del autor.
* Incluir todos los préstamos del libro (usar `with(['author', 'loans'])`).
* Retornar un error 404 si el libro no existe.

#### Endpoint 3: POST /api/loans

**Requisitos:**

* Crear un nuevo préstamo.

* Validar los datos recibidos:

  * `book_id` (required, exists:books,id)
  * `user_name` (required, string, max:255)
  * `loan_date` (required, date)

* Validar que el libro exista y que esté disponible (`available = true`).

* Si está disponible:

  * Crear el préstamo con estado 'active'.
  * Actualizar el libro a `available = false`.
  * Retornar el préstamo creado con un código de estado 201.

* Si no está disponible:

  * Retornar un error 400 con un mensaje adecuado.

**Ejemplo de solicitud:**

```json
{
  "book_id": 1,
  "user_name": "Juan Pérez",
  "loan_date": "2024-12-10"
}
```

**Respuesta exitosa:**

```json
{
  "success": true,
  "message": "Préstamo creado exitosamente",
  "data": {
    "id": 6,
    "book_id": 1,
    "user_name": "Juan Pérez",
    "loan_date": "2024-12-10",
    "return_date": null,
    "status": "active"
  }
}
```

**Respuesta de error (libro no disponible):**

```json
{
  "success": false,
  "message": "El libro no está disponible para préstamo"
}
```

#### Archivo: `routes/api.php`

**Requisitos:**

* Descomentar y/o agregar las rutas necesarias:

```php
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/loans', [BookController::class, 'store']);
```

---

## Estructura de Base de Datos

### Tabla: **authors**

| Campo      | Tipo       | Descripción        |
| ---------- | ---------- | ------------------ |
| id         | bigInteger | PK, auto-increment |
| name       | string     | Nombre del autor   |
| country    | string     | País de origen     |
| created_at | timestamp  | -                  |
| updated_at | timestamp  | -                  |

### Tabla: **books**

| Campo          | Tipo       | Descripción               |
| -------------- | ---------- | ------------------------- |
| id             | bigInteger | PK, auto-increment        |
| title          | string     | Título del libro          |
| author_id      | bigInteger | FK a authors              |
| isbn           | string     | ISBN único                |
| published_year | integer    | Año de publicación        |
| available      | boolean    | Indica si está disponible |
| created_at     | timestamp  | -                         |
| updated_at     | timestamp  | -                         |

### Tabla: **loans**

| Campo       | Tipo           | Descripción           |
| ----------- | -------------- | --------------------- |
| id          | bigInteger     | PK, auto-increment    |
| book_id     | bigInteger     | FK a books            |
| user_name   | string         | Nombre del usuario    |
| loan_date   | date           | Fecha del préstamo    |
| return_date | date, nullable | Fecha de devolución   |
| status      | string         | 'active' o 'returned' |
| created_at  | timestamp      | -                     |
| updated_at  | timestamp      | -                     |

---

## Cómo Probar tu Código

Puedes probar los endpoints usando herramientas como cURL o Postman.

**1. Listar todos los libros:**

```bash
curl http://localhost:8000/api/books
```

**2. Ver detalle de un libro:**

```bash
curl http://localhost:8000/api/books/1
```

**3. Crear un préstamo:**

```bash
curl -X POST http://localhost:8000/api/loans \
  -H "Content-Type: application/json" \
  -d '{
    "book_id": 1,
    "user_name": "Juan Pérez",
    "loan_date": "2024-12-10"
  }'
```

**4. Intentar prestar un libro no disponible (debe fallar):**

```bash
curl -X POST http://localhost:8000/api/loans \
  -H "Content-Type: application/json" \
  -d '{
    "book_id": 2,
    "user_name": "María García",
    "loan_date": "2024-12-10"
  }'
```

---

## Checklist de Entrega

Antes de hacer commit, verifica que:

* [ ] La migración de `loans` esté completa con todas las columnas.
* [ ] Todas las relaciones estén definidas en los modelos.
* [ ] El seeder crea autores,
