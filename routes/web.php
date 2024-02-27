<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/register', [AuthController::class, 'view_register']);
Route::post('/create_user', [AuthController::class, 'create_user']);

Route::get('/login', [AuthController::class, 'view_login'])->name('login');
Route::post('/login_user', [AuthController::class, 'login_user']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [UserController::class, 'index']);


    Route::get('/edit_user', [UserController::class,'show']);
    Route::post('/update_user', [UserController::class,'update_user']);
});
