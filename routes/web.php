<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->where('id', '[0-9]+')->name('users.update');
    Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('users.delete');

    // Users Groups
    Route::get('/roles', [UserRoleController::class, 'index'])->name('user-roles');
    Route::get('/roles/create', [UserRoleController::class, 'create'])->name('user-role.create');
    Route::post('/roles', [UserRoleController::class, 'store'])->name('user-role.store');
    Route::get('/roles/{group}/edit', [UserRoleController::class, 'edit'])->name('user-role.edit');
    Route::put('/roles/{group}', [UserRoleController::class, 'update'])->name('user-role.update');
    Route::delete('/roles/{group}', [UserRoleController::class, 'destroy'])->name('user-role.delete');
    // Users Groups Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');
});

require __DIR__ . '/auth.php';
