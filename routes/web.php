<?php

use App\Mail\MailMessage;
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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');

Route::resource('task', 'App\Http\Controllers\TaskController')
    ->middleware('verified');

Route::get('finished-tasks', [\App\Http\Controllers\TaskController::class, 'finished_index'])
    ->middleware('verified');

Route::get('mail', function (){
    return new MailMessage();
});
