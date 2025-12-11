# Backend Challenge - API de Biblioteca

**Tiempo límite:** 30 minutos  
**Tecnologías:** PHP Laravel, Eloquent ORM, MySQL

## Contexto

Debes completar una API REST para un sistema de gestión de biblioteca digital. El proyecto tiene la estructura base de Laravel con modelos y migraciones iniciales que requieren implementación.

## Objetivo

Completar el backend para que la API pueda:

-   Gestionar libros y autores con sus relaciones
-   Registrar préstamos de libros
-   Validar disponibilidad antes de prestar
-   Proveer endpoints REST funcionales

## Setup

```bash
cd backend-challenge
composer install
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
# Ejecutar migraciones y seeders cuando estén listos
php artisan migrate
php artisan db:seed
php artisan serve
```

## Tareas

### 1. Migración y Relaciones (10 min)

**Migración `loans`:** Completar tabla con columnas: `book_id`, `user_name`, `loan_date`, `return_date`, `status`. Incluir foreign key a `books` con cascade.

**Modelos:** Definir relaciones Eloquent:

-   `Author` → `hasMany` Books
-   `Book` → `belongsTo` Author, `hasMany` Loans
-   `Loan` → `belongsTo` Book

### 2. Seeder (8 min)

Poblar la base de datos con:

-   3 autores (nombre, país)
-   10 libros (variando disponibilidad)
-   5 préstamos (3 activos, 2 devueltos)

Los préstamos activos deben corresponder a libros no disponibles.

### 3. Endpoints API (12 min)

Implementar en `BookController`:

**GET /api/books**

-   Listar libros con autor incluido
-   Retornar JSON: `{ "success": true, "data": [...] }`

**GET /api/books/{id}**

-   Detalle del libro con autor y préstamos
-   Retornar 404 si no existe

**POST /api/loans**

-   Crear préstamo validando: `book_id`, `user_name`, `loan_date`
-   Verificar disponibilidad del libro
-   Si disponible: crear préstamo, actualizar libro a no disponible, retornar 201
-   Si no disponible: retornar 400 con mensaje de error

Descomentar rutas en `routes/api.php`.

## Estructura de Base de Datos

**authors:** id, name, country, timestamps  
**books:** id, title, author_id, isbn, published_year, available, timestamps  
**loans:** id, book_id, user_name, loan_date, return_date, status, timestamps

## Pruebas

```bash
# Listar libros
curl http://localhost:8000/api/books

# Ver detalle
curl http://localhost:8000/api/books/1

# Crear préstamo
curl -X POST http://localhost:8000/api/loans \
  -H "Content-Type: application/json" \
  -d '{"book_id": 1, "user_name": "Juan Pérez", "loan_date": "2024-12-10"}'
```

## Entrega

Verifica antes de commit:

-   [ ] Migración de loans completa
-   [ ] Relaciones definidas en modelos
-   [ ] Seeder funcional con datos coherentes
-   [ ] Endpoints implementados y funcionando
-   [ ] Validaciones correctas
-   [ ] Sin errores en consola

---

**Nota:** Se espera conocimiento de Laravel. Consulta la documentación oficial si necesitas referencias específicas.
