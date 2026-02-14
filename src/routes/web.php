<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', function () {
    return view('thanks');
});

Route::get('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
    Route::get('/search', [AuthController::class, 'admin'])->middleware('auth');
    Route::get('/reset', function () {
        return redirect('/admin');
    });
    Route::get('/export', [AuthController::class, 'export']);
    Route::post('/delete', [AuthController::class, 'destroy'])->name('admin.delete');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});