<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contacts',[App\Http\Controllers\ContactsController::class, 'get'])->name('user.contacts');
Route::get('/conversation/{id}',[App\Http\Controllers\ContactsController::class, 'getMessageFor'])->name('conatcts.message');
Route::post('/conversation/send',[App\Http\Controllers\ContactsController::class, 'send'])->name('message.send');
