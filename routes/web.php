<?php

use App\Http\Controllers\SecretaireController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SeminaireValidationController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('seminaires.index');
    })->name('dashboard');
});





Route::middleware(['auth:sanctum'])->group(function () {
   



    Route::middleware(['enseignant'])->group(function() {
        Route::get('/seminaires/create', [SeminaireController::class, 'create'])->name('seminaires.create');
        Route::post('/seminaires', [SeminaireController::class, 'store'])->name('seminaires.store');
    });


    Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
       
        Route::resource('users', UserController::class)->only(['index', 'create', 'store']);


        Route::get('seminaires/validation', [SeminaireValidationController::class, 'index'])->name('seminaires.validation');
        Route::patch('seminaires/{seminaire}/valider', [SeminaireValidationController::class, 'valider'])->name('seminaires.valider');
    });

    Route::get('/seminaires', [SeminaireController::class, 'index'])->name('seminaires.index');
    Route::get('/seminaires/{seminaire:slug}', [SeminaireController::class, 'show'])->name('seminaires.show');
});