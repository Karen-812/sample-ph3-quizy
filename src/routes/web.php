<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
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
});

// クイズ一覧
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{id}', [QuizController::class, 'detail'])->whereNumber('id')->name('quiz.detail');

*/

Auth::routes();
require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/webapp/home', [WebappController::class, 'index'])->middleware('auth');
Route::post('/webapp/home', [WebappController::class, 'post']);
Route::get('/webapp/home/user/edit', [WebappController::class, 'user_edit'])->middleware('auth')->name('user_edit');
Route::get('/webapp/home/news', [NewsController::class, 'index']);
Route::get('/webapp/home/news/{id}', [NewsController::class, 'detail']);

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/webapp/admin/home', [AdminController::class, 'index'])->middleware('auth');;
    Route::post('/webapp/admin/home/content', [AdminController::class, 'content_change'])->middleware('auth')->name('admin.content_change');
    Route::post('/webapp/admin/home/language', [AdminController::class, 'language_change'])->middleware('auth')->name('admin.language_change');
    Route::post('/webapp/admin/home/content_new', [AdminController::class, 'content_add'])->middleware('auth')->name('admin.content_add');
    Route::post('/webapp/admin/home/language_new', [AdminController::class, 'language_add'])->middleware('auth')->name('admin.language_add');

    Route::get('/webapp/admin/home/user', [AdminController::class, 'user_index'])->middleware('auth');
    Route::get('/webapp/admin/home/user/change', [AdminController::class, 'user_change'])->middleware('auth')->name('admin.user_change');
    Route::post('/webapp/admin/home/user/add', [AdminController::class, 'user_add'])->middleware('auth')->name('admin.user_add');
});

