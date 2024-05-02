<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

// Rute untuk antarmuka pengguna
Route::get('/', function () {
    return view('Users.register');
});

Route::get('/users', [UserController::class, 'index'])->name('Users.index');
Route::get('/users/{id}', [UserController::class, 'get'])->name('Users.get');
Route::get('/register', [UserController::class, 'registerForm'])->name('Users.registerForm');
Route::post('/register', [UserController::class, 'register'])->name('Users.register');
Route::get('/login', [UserController::class, 'loginForm'])->name('Users.loginForm');
Route::post('/login', [UserController::class, 'login'])->name('Users.login');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('Users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('Users.update');
Route::delete('/logout', [UserController::class, 'logout'])->name('logout');

// Rute untuk ExpenseController
Route::get('/expenses', [ExpenseController::class, 'index'])->name('Expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'createForm'])->name('Expenses.createForm');
Route::post('/expenses/create', [ExpenseController::class, 'create'])->name('Expenses.create');
Route::get('/expenses/{expense}', [ExpenseController::class, 'get'])->name('Expenses.get');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'updateForm'])->name('Expenses.updateForm');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('Expenses.update');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'delete'])->name('Expenses.delete');
Route::get('/search', [ExpenseController::class, 'search'])->name('Expenses.search');

