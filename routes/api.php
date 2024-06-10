<?php

use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//Menu
Route::prefix('menus')->name('menus.')->group(
    function(){
        Route::get('', [MenuController::class, 'fetch'])->name('fetch');
        Route::get('/{id}', [MenuController::class, 'fetchById'])->name('fetchById');
});

//Transaction Menu
Route::prefix('transactions')->name('menus.')->group(
    function(){
        Route::get('', [TransactionController::class, 'fetch'])->name('fetch');
        Route::post('', [TransactionController::class, 'create'])->name('create');
});
