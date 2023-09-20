<?php

use App\Http\Controllers\classroomsController;
use App\Http\Controllers\ClassroomUserController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TopicController;
use App\Models\ClassroomUser;
use App\Models\Comment;
use App\Models\Post;
use GuzzleHttp\Promise\Create;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('plans', [PlansController::class, 'index'])
    ->name('plans');


Route::middleware('auth')->group(function () {

    Route::post('subscriptions', [SubscriptionsController::class, 'store'])
        ->name('subscriptions.store');

    Route::get('/classroom/{classroom}/join', [JoinClassroomController::class, 'create'])
        ->name('classroom.join');
    Route::post('/classroom/{classroom}/join', [JoinClassroomController::class, 'store'])
        ->name('classroom.jstore');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('classroom', classroomsController::class)->parameter('classroom', 'id')
        ->names(
            ['destroy' => 'classroom.delete',]
        );
    Route::resource('classroom.classwork', ClassworkController::class);
    // ->shallow(); //هنا بتخلي الراوت الخاص بالتحديث والتعديل والحذف والعرض بدون الباراميتر الخاص بالكلاسروم

    Route::post('/Topic/store/{url}/{id?}', [TopicController::class, 'store'])->name('Topic.store');
    Route::get('/Topic/classroom/Topics/{id}', [TopicController::class, 'show'])->name('Topic.show');
    Route::put('/Topic/classroom/Topics/{url}/{id?}', [TopicController::class, 'update'])->name('Topic.update');
    Route::delete('/classroom/topic/delete/', [TopicController::class, 'destroy'])->name('Topic.delete');

    // Route::resource('Topic',TopicController::class);

    Route::get('classroom/{classroom}/people', [ClassroomUserController::class, 'index'])->name('classroom.people');
    Route::delete('classroom/{classroom}/people', [ClassroomUserController::class, 'destroy'])->name('classroom.people.destroy');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('classroom/{classroom}/post', [PostController::class, 'store'])->name('post.store');

    Route::post('classwork/{classwork}/submissions', [SubmissionController::class, 'store'])
        ->name('submissions.store')
        ->middleware('can:submissions.create,classwork');

    Route::get('submissions/{submission}/file', [SubmissionController::class, 'file'])->name('submissions.file');
});
