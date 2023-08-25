<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleVenteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{libelle}', [CategorieController::class, 'show'])->name('categories.show');
Route::post("/categories", [CategorieController::class, "store"])->name("categories.store");
Route::match(['put', 'patch'], '/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/delete/', [CategorieController::class, 'destroy'])->name('categories.destroy');

Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get("/fournisseur", [FournisseurController::class, "index"])->name("fournisseur.index");

Route::get("/articleFournisseurCategorie", [ArticleController::class, "getCategoryFournisseurArticle"])->name("articleFournisseurCategorie.index");
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::match(['put', 'patch'], '/article/{id}', [ArticleController::class, 'update'])->name("articles.update");

// routes article de vente
Route::get("/articleVente", [ArticleVenteController::class, "index"])->name("articleVente.index");
Route::post("/articleVente", [ArticleVenteController::class, "store"])->name("articleVente.store");