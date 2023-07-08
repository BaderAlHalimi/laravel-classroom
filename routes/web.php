<?php

use App\Http\Controllers\ClassroomsController;
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
// Route::get('/','welcome');

Route::get('/classroom',[ClassroomsController::class,'index']);
// Route::get('/classroom','App\Http\Controllers\ClassroomsController@index');
Route::resource('/Classrooms', ClassroomsController::class);