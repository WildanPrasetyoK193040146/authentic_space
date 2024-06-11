<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
        Route::get('/admin/profile/edit', 'editprofile')->name('admin.profile.edit');
        Route::post('/admin/profile/store', 'storeprofile')->name('admin.profile.store');
        Route::get('/admin/ubah/password', 'changepassword')->name('admin.change.password');
        Route::post('/admin/update/password', 'updatepassword')->name('admin.update.password');
});
});

Route::middleware(['auth'])->group(function () {
Route::controller(AdminController::class)->group(function(){
        Route::get('/menu/all', 'allMenu')->name('all.menu');
        Route::get('/menu/add', 'addMenu')->name('add.menu');
        Route::post('/menu/store', 'storeMenu')->name('store.menu');
        Route::get('/menu/edit/{id}', 'editMenu')->name('edit.menu');
        Route::post('/menu/update', 'updateMenu')->name('update.menu');
        Route::get('/menu/delete/{id}', 'deleteMenu')->name('delete.menu');
        Route::get('/pesanan/all', 'allPesanan')->name('all.pesanan');
        Route::post('/pesanan/update/status/success', 'updateSuccess')->name('update.success');
        Route::post('/pesanan/update/status/reject', 'updateReject')->name('update.reject');
        Route::get('/pesanan/detail/{id}', 'detailPesanan')->name('detail.pesanan');
    });
});

require __DIR__.'/auth.php';

