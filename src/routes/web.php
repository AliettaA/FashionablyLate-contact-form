<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/admin/export', [AuthController::class, 'export'])->name('admin.export');
    Route::post('/admin/delete', [AuthController::class, 'destroy'])->name('admin.delete');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});