<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\LeaderController as AdminLeaderController;
use App\Http\Controllers\Admin\CampusTourController as AdminCampustTourController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// administrator
Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('gallery', AdminGalleryController::class);

    Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
    Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');

    // About 
    Route::resource('about', AdminAboutController::class);
    Route::post('about-image/{about}', [AdminAboutController::class, 'imageStore'])->name('about.image.store');
    Route::delete('about-image/{about}', [AdminAboutController::class, 'imageDestroy'])->name('about.image.destroy');

    // leader
    Route::resource('leader', AdminLeaderController::class);
    Route::post('leader-image/{leader}', [AdminLeaderController::class, 'imageStore'])->name('leader.image.store');
    Route::delete('leader-image/{leader}', [AdminLeaderController::class, 'imageDestroy'])->name('leader.image.destroy');

    //Camputours
    Route::resource('campustour', AdminCampustTourController::class);

    //Staff
    Route::resource('staff', AdminStaffController::class);

});



require __DIR__.'/auth.php';
