<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\TopicController;
use App\Models\Classroom;
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

// Route::get('/classroom',[ClassroomsController::class,'index'])->name('Classroom.index');
// // Route::get('/classroom','App\Http\Controllers\ClassroomsController@index');
// Route::get('/classroom/edit/{id}',[ClassroomsController::class,'edit'])->where('id','[0-9]+')->name('Classroom.edit');
// Route::get('/classroom/create',[ClassroomsController::class,'create'])->name('Classroom.create');
// Route::post('/classroom/store',[ClassroomsController::class,'store'])->name('Classroom.store');
// Route::get('/classroom/{id}',[ClassroomsController::class,'show'])->where('id','[0-9]+')->name('Classroom.show');
// Route::put('/classroom/update/{id}',[ClassroomsController::class,'update'])->name('Classroom.update');
// Route::delete('/classroom/destroy/{id}',[ClassroomsController::class,'destroy'])->name('Classroom.delete');


//// Route resource////
Route::resource('classroom', ClassroomsController::class)->parameter('classroom', 'id')
    ->names(
        ['destroy' => 'classroom.delete',]
    );





Route::post('/Topic/store/{url}/{id?}', [TopicController::class, 'store'])->name('Topic.store');
Route::get('/Topic/classroom/Topics/{id}', [TopicController::class, 'show'])->name('Topic.show');
Route::put('/Topic/classroom/Topics/{url}/{id?}', [TopicController::class, 'update'])->name('Topic.update');
Route::delete('/classroom/topic/delete/{url}/{id?}', [TopicController::class, 'destroy'])->name('Topic.delete');
