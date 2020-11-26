<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;



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

Route::get('/', [TopicController::class, 'index'])->name('topics.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('topics', TopicController::class)->except('logout');

Route::get('/logout' , 'Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy')->name('logout');

Route::post('/comments/{topic}' , [CommentController::class , 'store'])->name('comments.store');

Route::post('/commentReply/{comment}' , [CommentController::class , 'storeCommentReply'])->name('comment.storeReply');

Route::get('/showFromNotification/{topic}/{notification}' , [TopicController::class , 'showFromNotification'])->name('showFromNotification');










