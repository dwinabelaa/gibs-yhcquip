<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ArticleCategoryController as AdminArticleCategoryController;

use App\Http\Controllers\ProfileController;
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
// Welcome
Route::get('/', function () {
  return view('welcome');
});

// Dashboard


Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth
Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// administrator
Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {
  Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  Route::resource('gallery', AdminGalleryController::class);
  Route::resource('article', AdminArticleController::class);
  Route::resource('article-category', AdminArticleCategoryController::class);
  Route::get('article-comment', [AdminArticleController::class, 'category'])->name('comment');
  Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
  Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');
});





require __DIR__ . '/auth.php';
