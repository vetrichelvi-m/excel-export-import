<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;

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

// exceloperation
Route::get('/user', [UserController::class, 'index']);
Route::get('user/export', [UserController::class, 'export'])->name('export');
Route::get('customer/export', [UserController::class, 'export']);
Route::get('user/import', [UserController::class, 'import']);
Route::post('customer/import', [UserController::class, 'importExcel']);
Route::post('user/add', [UserController::class, 'importExcel']);

//curd opertaion
Route::get('userslist', [UserController::class, 'list'])->name('list');
Route::get('useradd', [UserController::class, 'create']);
Route::post('userstore', [UserController::class, 'store']);
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{user}', [UserController::class, 'delete'])->name('user.delete');






