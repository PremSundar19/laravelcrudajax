<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesController;
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
Route::get('/',function(){ return view('welcome');});
Route::get('/index',[EmployeeController::class,'index']);
Route::post("/employee-added",[EmployeeController::class,'saveEmployee'])->name('add');
Route::get('employee',[EmployeeController::class,'fetchEmployee'])->name('fetchData');

