<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'PasswordUpdate'])->name('admin.password.update');
});

Route::controller(ReviewController::class)->middleware('auth')->group(function () {
    Route::get('/all/review', 'AllReview')->name('all.review');
    Route::get('/add/review', 'AddReview')->name('add.review');
    Route::post('/store/review', 'StoreReview')->name('store.review');
    Route::get('/edit/review/{id}', 'EditReview')->name('edit.review');
    Route::put('/update/review/{id}', 'UpdateReview')->name('update.review');
    Route::delete('/delete/review/{id}', 'DeleteReview')->name('delete.review');
});
Route::controller(SliderController::class)->middleware('auth')->group(function () {
    Route::get('/get/slider', 'GetSlider')->name('get.slider');
    Route::put('/update/slider', 'UpdateSlider')->name('update.slider');
    Route::post('/edit-slider/{id}', 'EditSlider');
    Route::post('/edit-features/{id}', 'EditFeatures');
    Route::post('/edit-reviews/{id}', 'EditReviews');
    Route::post('/edit-answers/{id}', 'EditAnswers');

});
Route::controller(HomeController::class)->middleware('auth')->group(function () {
    Route::get('/all/feature', 'AllFeature')->name('all.feature');
    Route::get('/add/feature', 'AddFeature')->name('add.feature');
    Route::post('/store/feature', 'StoreFeature')->name('store.feature');
    Route::get('/edit/feature/{id}', 'EditFeature')->name('edit.feature');
    Route::put('/update/feature/{id}', 'UpdateFeature')->name('update.feature');
    Route::delete('/delete/feature/{id}', 'DeleteFeature')->name('delete.feature');
});
Route::controller(HomeController::class)->middleware('auth')->group(function () {
    Route::get('/get/clarifis', 'GetClarifis')->name('get.clarifis');
    Route::put('/update/clarifis', 'UpdateClarifis')->name('update.clarifis');
});

Route::controller(HomeController::class)->middleware('auth')->group(function () {
    Route::get('/get/usability', 'GetUsability')->name('get.usability');
    Route::put('/update/usability', 'UpdateUsability')->name('update.usability');
});

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogIn'])->name('admin.login');
Route::get('/verify', [AdminController::class, 'ShowVerification'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'VerificationVerify'])->name('custom.verification.verify');
require __DIR__ . '/auth.php';
