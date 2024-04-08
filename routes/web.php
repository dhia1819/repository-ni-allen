<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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


    //User Module
	Route::get('/users', [Controllers\UserController::class, 'index']);
	Route::get('/users', [Controllers\UserController::class, 'index'])->name('users');
	Route::get('/fetchall', [Controllers\UserController::class, 'fetchAll'])->name('fetchAll');
	Route::get('/users/create', [Controllers\UserController::class, 'create']);
	Route::post('/users/store', [Controllers\UserController::class, 'store']);
	Route::get('/users/{id}/edit', [Controllers\UserController::class, 'edit']);
	Route::post('/users/{id}/update', [Controllers\UserController::class, 'update'])->name('user.update');

    //Category Module
	Route::get('/category', [Controllers\CategoryController::class, 'index']);
    Route::get('/users/create', [Controllers\CategoryController::class, 'create']);
    Route::post('/category/store', [Controllers\CategoryController::class, 'store']);
    Route::get('/category/{id}/edit', [Controllers\CategoryController::class, 'edit'])->name('category.edit');
	Route::post('/category/{id}/update', [Controllers\CategoryController::class, 'update'])->name('category.update');

    //All Equipment Module
    Route::get('/dowload-equipment', [Controllers\EquipmentController::class, 'downloadEquipment'])->name('download.equipment');
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

    //Borrow Module
    Route::get('/borrow/return', [Controllers\BorrowController::class, 'return'])->name('return');
    Route::get('/borrow/return/{id}', [Controllers\BorrowController::class, 'showreturn'])->name('borrow.return');

    Route::post('/borrow/{id}/phase', [Controllers\BorrowController::class, 'phase'])->name('borrow.phase');

    //Borrow History Module
    Route::get('/borrow/history', [Controllers\HistoryController::class, 'history'])->name('history');
    Route::get('/borrow/showhistory/{id}', [Controllers\HistoryController::class, 'showhistory'])->name('show.history');
    Route::get('/dowload-history', [Controllers\HistoryController::class, 'downloadHistory'])->name('download.history');

    //Office Module
	Route::get('/office', [Controllers\OfficeController::class, 'index'])->name('office');
    Route::post('/office/store', [Controllers\OfficeController::class, 'store']);
	Route::post('/office/{id}/update', [Controllers\OfficeController::class, 'update'])->name('office.update');

    
    //employee module
    Route::get('/employee', [Controllers\EmployeeController::class, 'index'])->name('employee');
    Route::get('/fetchall', [Controllers\EmployeeController::class, 'fetchAll'])->name('fetchAll');
    Route::get('/employee/create', [Controllers\EmployeeController::class, 'create']);
	Route::post('/employee/store', [Controllers\EmployeeController::class, 'store']);
	Route::get('/employee/{id}/edit', [Controllers\EmployeeController::class, 'edit']);
	Route::post('/employee/{id}/update', [Controllers\EmployeeController::class, 'update'])->name('employee.update');


});