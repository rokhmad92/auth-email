<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;


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

Route::controller(EmailController::class)->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'login');
    Route::get('/register', 'registerView');
    Route::post('/register', 'store');
    Route::get('/verify', 'verify')->name('verify');
    Route::get('/done', 'done')->middleware('auth', 'emailVerify');
});
