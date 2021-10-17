<?php

use App\Http\Controllers\APIController\AllocataionController;
use App\Http\Controllers\APIController\AttributeController;
use App\Http\Controllers\APIController\AuthController;
use App\Http\Controllers\APIController\CategoryController;
use App\Http\Controllers\APIController\DamagedItemController;
use App\Http\Controllers\APIController\DepartmentController;
use App\Http\Controllers\APIController\InventoryController;
use App\Http\Controllers\APIController\OfficeController;
use App\Http\Controllers\APIController\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//User
//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);

//Categories
//get all
Route::get('/categories', [CategoryController::class, 'index']);
//show by id
Route::get('/show-category/{id}', [CategoryController::class, 'show']);
//search by name
Route::get('/search-category/{text}', [CategoryController::class, 'search']);

//Inventory
//get all
Route::get('/inventory', [InventoryController::class, 'index']);
//show by id
Route::get('/show-inventory/{id}', [InventoryController::class, 'show']);
//search by name
Route::get('/search-inventory/{text}', [InventoryController::class, 'search']);

//Attributes
//get all
Route::get('/attributes', [AttributeController::class, 'index']);
//show by id
Route::get('/show-attribute/{id}', [AttributeController::class, 'show']);
//search by name
Route::get('/search-attribute/{text}', [AttributeController::class, 'search']);

//Departments
//get all
Route::get('/departments', [DepartmentController::class, 'index']);
//show by id
Route::get('/show-department/{id}', [DepartmentController::class, 'show']);
//search by name
Route::get('/search-department/{text}', [DepartmentController::class, 'search']);

//Offices
//get all
Route::get('/offices', [OfficeController::class, 'index']);
//show by id
Route::get('/show-office/{id}', [OfficeController::class, 'show']);
//search by name
Route::get('/search-office/{text}', [OfficeController::class, 'search']);

//Persons
//get all
Route::get('/persons', [PersonController::class, 'index']);
//show by id
Route::get('/show-person/{id}', [PersonController::class, 'show']);
//search by name
Route::get('/search-person/{text}', [PersonController::class, 'search']);

//Allocations
//get allocations
Route::get('/allocations', [AllocataionController::class, 'index']);
//get all
Route::get('/all-allocations', [AllocataionController::class, 'allocations_including_deallocated']);
//show by id
Route::get('/show-allocation/{id}', [AllocataionController::class, 'show']);
//show by person name
Route::get('/person-allocation/{text}', [AllocataionController::class, 'SearchPersonName']);
//show by office name
Route::get('/office-allocation/{text}', [AllocataionController::class, 'SearchOfficeName']);

//Damaged Items
//get damaged
Route::get('/damaged-items', [DamagedItemController::class, 'index']);
//get all damaged including repaired
Route::get('/all-damaged-items', [DamagedItemController::class, 'damaged_including_repaired']);
//show by id
Route::get('/show-damaged-item/{id}', [DamagedItemController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    //User
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //Categories
    //add
    Route::post('/add-category', [CategoryController::class, 'create']);
    //update
    Route::put('/update-category/{id}', [CategoryController::class, 'update']);
    //delete
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);

    //Inventory
    //add
    Route::post('/add-inventory', [InventoryController::class, 'create']);
    //update
    Route::put('/update-inventory/{id}', [InventoryController::class, 'update']);
    //delete
    Route::delete('/delete-inventory/{id}', [InventoryController::class, 'destroy']);

    //Attributes
    //add
    Route::post('/add-attribute', [AttributeController::class, 'create']);
    //update
    Route::put('/update-attribute/{id}', [AttributeController::class, 'update']);
    //delete
    Route::delete('/delete-attribute/{id}', [AttributeController::class, 'destroy']);

    //Departments
    //add
    Route::post('/add-department', [DepartmentController::class, 'create']);
    //update
    Route::put('/update-department/{id}', [DepartmentController::class, 'update']);
    //delete
    Route::delete('/delete-department/{id}', [DepartmentController::class, 'destroy']);

    //Offices
    //add
    Route::post('/add-office', [OfficeController::class, 'create']);
    //update
    Route::put('/update-office/{id}', [OfficeController::class, 'update']);
    //delete
    Route::delete('/delete-office/{id}', [OfficeController::class, 'destroy']);

    //Persons
    //add
    Route::post('/add-person', [PersonController::class, 'create']);
    //update
    Route::put('/update-person/{id}', [PersonController::class, 'update']);
    //delete
    Route::delete('/delete-person/{id}', [PersonController::class, 'destroy']);

    //Allocations
    //add
    Route::post('/add-allocation', [AllocataionController::class, 'create']);
    //update
    Route::put('/update-allocation/{id}', [AllocataionController::class, 'update']);
    //delete
    Route::delete('/delete-allocation/{id}', [AllocataionController::class, 'destroy']);

    //Damaged Items
    //add
    Route::post('/add-damaged-item', [DamagedItemController::class, 'create']);
    //update
    Route::put('/update-damaged-item/{id}', [DamagedItemController::class, 'update']);
    //delete
    Route::delete('/delete-damaged-item/{id}', [DamagedItemController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});