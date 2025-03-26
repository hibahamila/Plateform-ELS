<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;
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

@include_once('admin_web.php');
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect()->route('index');
    })->name('/');
    
    Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');
    
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'admin.dashboard.default')->name('index');
        Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
    });
    
    Route::view('default-layout', 'multiple.default-layout')->name('default-layout');
    Route::view('compact-layout', 'multiple.compact-layout')->name('compact-layout');
    Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    
// Route::get('/reponses', [ReponseController::class, 'index'])->name('reponses.index');
// Route::get('/reponses/create', [ReponseController::class, 'create'])->name('reponses.create');
// Route::post('/reponses', [ReponseController::class, 'store'])->name('reponses.store');
// Route::get('/reponses/{id}', [ReponseController::class, 'show'])->name('reponses.show');
// Route::get('/reponses/{id}/edit', [ReponseController::class, 'edit'])->name('reponses.edit');
// Route::put('/reponses/{id}', [ReponseController::class, 'update'])->name('reponses.update');
// Route::delete('/reponses/{id}', [ReponseController::class, 'destroy'])->name('reponses.destroy');


 



});
Auth::routes();

