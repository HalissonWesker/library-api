<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas públicas
Route::post('register', [AuthController::class, 'register']);// cadastrar usuário
Route::post('login', [AuthController::class, 'login']);// Login

// Rotas protegidas para usuários autenticados
Route::middleware(['auth:api'])->group(function () {
    Route::get('books', [BookController::class, 'index']); // Listar todos os livros
    Route::get('books/{book}', [BookController::class, 'show']); // Ver detalhes de um livro específico
    Route::post('logout', [AuthController::class, 'logout']); // Logout
    Route::get('books/search', [BookController::class, 'search']); // Pesquisar livros por nome
});

// Grupo de rotas protegidas e restritas a administradores
Route::middleware(['auth:api', 'admin'])->group(function () {
    
    // Prefixo 'books' aplicado apenas às rotas de criação, atualização e exclusão
    Route::prefix('books')->group(function () {
        Route::post('/', [BookController::class, 'store']); // Criar um livro
        Route::put('/{book}', [BookController::class, 'update']); // Atualizar um livro
        Route::delete('/{book}', [BookController::class, 'destroy']); // Deletar um livro
    });

    // Rotas generais de autores e empréstimos sem prefixo adicional
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('loans', LoanController::class);
});
