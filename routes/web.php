<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\AdminUtilisateurController;                                                                                                

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/utilisateurs', [AdminUtilisateurController::class, 'index'])
    ->name('admin.utilisateurs.index');

Route::get('/admin/utilisateurs/create', [AdminUtilisateurController::class, 'create'])
    ->name('admin.utilisateurs.create');

Route::post('/admin/utilisateurs', [AdminUtilisateurController::class, 'store'])
    ->name('admin.utilisateurs.store');

Route::put('/admin/utilisateurs/{id}/toggle', [AdminUtilisateurController::class, 'toggle'])
    ->name('admin.utilisateurs.toggle');