<?php

use App\Http\Controllers\admin\AttributeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\OfficeController;
use App\Http\Controllers\admin\PersonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::post('/categories', [CategoryController::class, 'create'])->middleware('auth');
Route::post('/categories/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware('auth');
Route::put('/categories', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware('auth');
Route::post('/search/category', [CategoryController::class, 'search'])->name('category.find')->middleware('auth');


Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory')->middleware('auth');
Route::post('/inventory', [InventoryController::class, 'create'])->middleware('auth');
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.delete')->middleware('auth');
Route::post('/inventory/{id}', [InventoryController::class, 'show'])->name('inventory.show')->middleware('auth');
Route::put('/inventory', [InventoryController::class, 'update'])->name('inventory.update')->middleware('auth');
Route::post('/search/inventory', [InventoryController::class, 'search'])->name('inventory.find')->middleware('auth');


Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes')->middleware('auth');
Route::post('/attributes', [AttributeController::class, 'create'])->middleware('auth');
Route::post('/attributes/{id}', [AttributeController::class, 'show'])->name('attribute.show')->middleware('auth');
Route::put('/attribute', [AttributeController::class, 'update'])->name('attribute.update')->middleware('auth');
Route::delete('/attribute/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete')->middleware('auth');
Route::post('/search/attribute', [AttributeController::class, 'search'])->name('attribute.find')->middleware('auth');


Route::get('/departments', [DepartmentController::class, 'index'])->name('departments')->middleware('auth');
Route::post('/departments', [DepartmentController::class, 'create'])->middleware('auth');
Route::post('/departments/{id}', [DepartmentController::class, 'show'])->name('department.show')->middleware('auth');
Route::put('/department', [DepartmentController::class, 'update'])->name('department.update')->middleware('auth');
Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.delete')->middleware('auth');
Route::post('/search/department', [DepartmentController::class, 'search'])->name('department.find')->middleware('auth');


Route::get('/offices', [OfficeController::class, 'index'])->name('offices')->middleware('auth');
Route::post('/offices', [OfficeController::class, 'create'])->middleware('auth');
Route::post('/offices/{id}', [OfficeController::class, 'show'])->name('office.show')->middleware('auth');
Route::put('/office', [OfficeController::class, 'update'])->name('office.update')->middleware('auth');
Route::delete('/office/{id}', [OfficeController::class, 'destroy'])->name('office.delete')->middleware('auth');
Route::post('/search/office', [OfficeController::class, 'search'])->name('office.find')->middleware('auth');

Route::get('/persons', [PersonController::class, 'index'])->name('persons')->middleware('auth');
Route::post('/persons', [PersonController::class, 'create'])->middleware('auth');
Route::post('/persons/{id}', [PersonController::class, 'show'])->name('person.show')->middleware('auth');
Route::put('/person', [PersonController::class, 'update'])->name('person.update')->middleware('auth');
Route::delete('/person/{id}', [PersonController::class, 'destroy'])->name('person.delete')->middleware('auth');
Route::post('/search/person', [PersonController::class, 'search'])->name('person.find')->middleware('auth');



