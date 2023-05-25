<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route

// pages


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
$controller_path = 'App\Http\Controllers';

    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
    Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

    //users
    Route::get('/users', $controller_path . '\pages\Users@index')->name ('pages-users');
    Route::get('/users/create', $controller_path. '\pages\Users@create')->name('page-users-create');
    Route::post('/users/store', $controller_path. '\pages\Users@store')->name('pages-users-store');
    Route::get('/users/show/{user_id}', $controller_path . '\pages\Users@show')->name ('pages-users-show');
    Route::post('/users/update', $controller_path . '\pages\Users@update')->name ('pages-users-update');
    Route::get('/users/destroy/{user_id}', $controller_path . '\pages\Users@destroy')->name ('pages-users-destroy');

    


    //API 



    Route::get('/encuentros', [FootballController::class, 'getUpcomingMatches'])->name('encuentros');
    Route::get('/principal', [FootballController::class, 'getChileanClubs'])->name('principal');
    Route::get('/actualizar', [FootballController::class, 'updateDataFromAPI']);
    Route::get('/estadios', [FootballController::class, 'getStadium'])->name('estadios');



});
