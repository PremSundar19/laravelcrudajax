<?php

use App\Http\Controllers\EmployeeController;
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
Route::get('index',function(){return view('view');});
Route::get('/employeeList',[EmployeeController::class,'employeeList']);
Route::post("/employeeAdd",[EmployeeController::class,'employeeAdd']);
Route::get('/employeeFetch/{id}',[EmployeeController::class,'employeeFetch']);
Route::post('/employeeUpdate',[EmployeeController::class,'employeeUpdate']);
Route::get('/employeDelete/{id}',[EmployeeController::class,'employeDelete']);
Route::get('/checkEmail',[EmployeeController::class,'checkEmail']);