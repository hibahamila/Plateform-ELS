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


    Route::prefix('chapitres')->name('chapitres.')->group(function () {
        Route::get('/', [ChapitreController::class, 'index'])->name('index');
        Route::get('create', [ChapitreController::class, 'create'])->name('create');
        Route::post('/', [ChapitreController::class, 'store'])->name('store');
        Route::get('{id}', [ChapitreController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ChapitreController::class, 'edit'])->name('edit');
        Route::put('{id}', [ChapitreController::class, 'update'])->name('update');
        Route::delete('{id}', [ChapitreController::class, 'destroy'])->name('destroy');
    });


    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index'); // Liste toutes les questions
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create'); // Formulaire pour créer une nouvelle question
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store'); // Enregistrer une nouvelle question
    Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show'); // Afficher une question spécifique
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy'); // Supprimer une question

    Route::middleware(['auth'])->group(function () {
        // Afficher la liste des cours
        Route::get('/cours', [CoursController::class, 'index'])->name('cours.index');
    
        // Afficher le formulaire de création d'un cours
        Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create');
    
        // Enregistrer un nouveau cours
        Route::post('/cours', [CoursController::class, 'store'])->name('cours.store');
    
        // Afficher les détails d'un cours
        Route::get('/cours/{id}', [CoursController::class, 'show'])->name('cours.show');
    
        // Afficher le formulaire d'édition d'un cours
        Route::get('/cours/{id}/edit', [CoursController::class, 'edit'])->name('cours.edit');
    
        // Mettre à jour un cours
        Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update');
    
        // Supprimer un cours
        Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');
    });



    
    
    Route::prefix('lessons')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name('lessons.index');
        Route::get('/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('/store', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
        Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        Route::put('/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
    });

Route::get('/reponses', [ReponseController::class, 'index'])->name('reponses.index');
Route::get('/reponses/create', [ReponseController::class, 'create'])->name('reponses.create');
Route::post('/reponses', [ReponseController::class, 'store'])->name('reponses.store');
Route::get('/reponses/{id}', [ReponseController::class, 'show'])->name('reponses.show');
Route::get('/reponses/{id}/edit', [ReponseController::class, 'edit'])->name('reponses.edit');
Route::put('/reponses/{id}', [ReponseController::class, 'update'])->name('reponses.update');
Route::delete('/reponses/{id}', [ReponseController::class, 'destroy'])->name('reponses.destroy');


Route::prefix('quizzes')->name('quizzes.')->group(function () {
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('create', [QuizController::class, 'create'])->name('create');
    Route::post('/', [QuizController::class, 'store'])->name('store');
    Route::get('{quiz}', [QuizController::class, 'show'])->name('show');
    Route::get('{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
    Route::put('{quiz}', [QuizController::class, 'update'])->name('update');
    Route::delete('{quiz}', [QuizController::class, 'destroy'])->name('destroy');
});

// Routes CRUD pour les catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index'); // Liste des catégories
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create'); // Formulaire de création
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store'); // Enregistrement d'une nouvelle catégorie
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show'); // Détails d'une catégorie
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit'); // Formulaire de modification
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update'); // Mise à jour d'une catégorie
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy'); // Suppression d'une catégorie



Route::prefix('formations')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('formations.index');
    Route::get('/create', [FormationController::class, 'create'])->name('formations.create');
    Route::post('/', [FormationController::class, 'store'])->name('formations.store');
    Route::get('/{id}', [FormationController::class, 'show'])->name('formations.show');
    Route::get('/{id}/edit', [FormationController::class, 'edit'])->name('formations.edit');
    Route::put('/{id}', [FormationController::class, 'update'])->name('formations.update');
    Route::delete('/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');
});


    
 



});
Auth::routes();

