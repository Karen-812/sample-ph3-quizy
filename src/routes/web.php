<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
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

/* Route::get('/', function () { return redirect('/quiz'); });


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/edit/{id}', 'AdminController@editIndex');
    Route::post('/admin/edit/{id}', 'AdminController@edit');
    Route::get('/admin/add/{id}', 'AdminController@addIndex');
    Route::post('/admin/add/{id}', 'AdminController@add');


    // 理想的なルーティング
    // // quiz
    // Route::get('/admin/quizzes', [AdminQuizController::class, 'index'])->name('admin.quiz.index');
    // Route::get('/admin/quiz/create', [AdminQuizController::class, 'create'])->name('admin.quiz.create');
    // Route::post('/admin/quiz/store', [AdminQuizController::class, 'store'])->name('admin.quiz.store');
    // Route::get('/admin/quiz/edit/{id}', [AdminQuizController::class, 'edit'])->name('admin.quiz.edit');
    // Route::post('/admin/quiz/update', [AdminQuizController::class, 'update'])->name('admin.quiz.update');

    // // big_question
    // Route::get('/admin/big_questions', [BigQuestionController::class, 'index'])->name('admin.big_question.index');
    // Route::get('/admin/big_question/create', [BigQuestionController::class, 'create'])->name('admin.big_question.create');
    // Route::post('/admin/quiz/store', [BigQuestionController::class, 'store'])->name('admin.big_question.store');
    // Route::get('/admin/quiz/edit/{id}', [BigQuestionController::class, 'edit'])->name('admin.big_question.edit');
    // Route::post('/admin/quiz/update', [BigQuestionController::class, 'update'])->name('admin.big_question.update');
    // Route::post('/admin/quiz/delete/{id}', [BigQuestionController::class, 'delete'])->name('admin.big_question.delete');
});

// クイズ一覧
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{id}', [QuizController::class, 'detail'])->whereNumber('id')->name('quiz.detail');

*/
Auth::routes();
require __DIR__.'/auth.php';

Route::get('/webapp/home', [WebappController::class, 'index'])->middleware('auth');
Route::post('/webapp/home', [WebappController::class, 'post']);

Route::middleware(['auth','can:isAdmin'])->group(function(){
    
Route::get('/webapp/admin/home', [AdminController::class, 'index'])->middleware('auth');;
Route::post('/webapp/admin/home/content', [AdminController::class, 'content_change'])->middleware('auth')->name('admin.content_change');
Route::post('/webapp/admin/home/language', [AdminController::class, 'language_change'])->middleware('auth')->name('admin.language_change');
Route::post('/webapp/admin/home/content_new', [AdminController::class, 'content_add'])->middleware('auth')->name('admin.content_add');
Route::post('/webapp/admin/home/language_new', [AdminController::class, 'language_add'])->middleware('auth')->name('admin.language_add');

Route::get('/webapp/admin/home/user', [AdminController::class, 'user_index'])->middleware('auth');
Route::get('/webapp/admin/home/user/change', [AdminController::class, 'user_change'])->middleware('auth')->name('admin.user_change');
Route::post('/webapp/admin/home/user/add', [AdminController::class, 'user_add'])->middleware('auth')->name('admin.user_add');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
