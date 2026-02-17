<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;



Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::get('/confirm', function () {return redirect('/');});
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', function () {return view('thanks');})->name('thanks');

Route::get('/register', [AuthController::class, 'create']);
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
    Route::get('/search', [AuthController::class, 'admin']);
    Route::get('/reset', function () {
        return redirect('/admin');
    });
    Route::get('/export', [AuthController::class, 'export'])->name('admin.export');
    Route::post('/delete', [AuthController::class, 'destroy'])->name('admin.delete');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});