<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', [LoginController::class,'index']);
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/dashboard', [EmployeeController::class,'index']);
Route::get('/employees', [EmployeeController::class,'employees'])->name('employees');
Route::get('/employees/add', [EmployeeController::class,'create'])->name('create');
Route::post('/employees/add', [EmployeeController::class,'store'])->name('store');
Route::get('/employees/edit/{id}', [EmployeeController::class,'edit'])->name('edit');
Route::post('/employees/update/{id}', [EmployeeController::class,'update'])->name('update');
Route::get('/employees/delete/{id}', [EmployeeController::class,'delete'])->name('delete');


Route::get('/employees/search', [EmployeeController::class,'search'])->name('search');


