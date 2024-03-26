<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Auth::routes([
  'register' => false, // Registration Routes...
  'reset'    => false, // Password Reset Routes...
  'verify'   => false, // Email Verification Routes...
]);

Route::get('/', [Controllers\HomeController::class, 'index']);
Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

	Route::get('/users', [Controllers\UserController::class, 'index']);
	Route::get('/fetchall', [Controllers\UserController::class, 'fetchAll'])->name('fetchAll');
	Route::get('/users/create', [Controllers\UserController::class, 'create']);
	Route::post('/users/store', [Controllers\UserController::class, 'store']);
	Route::get('/users/{id}/edit', [Controllers\UserController::class, 'edit']);
	Route::post('/users/{id}/update', [Controllers\UserController::class, 'update'])->name('user.update');

	Route::get('/category', [Controllers\CategoryController::class, 'index']);
    Route::get('/users/create', [Controllers\CategoryController::class, 'create']);
    Route::post('/category/store', [Controllers\CategoryController::class, 'store']);
    Route::get('/category/{id}/edit', [Controllers\CategoryController::class, 'edit'])->name('category.edit');
	Route::post('/category/{id}/update', [Controllers\CategoryController::class, 'update'])->name('category.update');

	Route::get('/equipment', [Controllers\EquipmentController::class, 'index'])->name('equipment');
    Route::get('/equipment/create', [Controllers\EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/equipment/store', [Controllers\EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/back', [Controllers\EquipmentController::class, 'index'])->name('equipment.back');
    Route::get('show/{id}',[Controllers\EquipmentController::class, 'show'])->name('equipment.show');
    Route::get('edit/{id}',[Controllers\EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::post('/equipment/{id}/update', [Controllers\EquipmentController::class, 'update'])->name('equipment.update');
	Route::get('/equipment/borrow/{id}', [Controllers\EquipmentController::class, 'borrow'])->name('equipment.borrow');
    Route::get('/back', [Controllers\EquipmentController::class, 'index'])->name('equipment.back');
    Route::post('/borrow/borrow/', [Controllers\EquipmentController::class, 'save'])->name('equipment.save');
    Route::get('/borrow/return', [Controllers\EquipmentController::class, 'return'])->name('return');
    Route::get('/borrow/return/{id}', [Controllers\EquipmentController::class, 'showreturn'])->name('borrow.return');
    Route::post('/borrow/{id}/phase', [Controllers\EquipmentController::class, 'phase'])->name('borrow.phase');
    Route::get('/borrow/history', [Controllers\EquipmentController::class, 'history'])->name('history');
    Route::get('/borrow/showhistory/{id}', [Controllers\EquipmentController::class, 'showhistory'])->name('show.history');


	Route::get('/office', [Controllers\OfficeController::class, 'index']);
    Route::post('/office/store', [Controllers\OfficeController::class, 'store']);
	Route::post('/office/{id}/update', [Controllers\OfficeController::class, 'update'])->name('office.update');


});