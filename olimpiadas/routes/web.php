<?php

use App\Http\Controllers\CampeonatosController;
use App\Http\Controllers\EquipesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JogosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParticipantesController;
use App\Http\Controllers\TimesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use GuzzleHttp\Middleware;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::resource('/campeonatos', CampeonatosController::class)->only('index','create','store','destroy','show');
Route::resource('campeonatos.jogos', JogosController::class)->only('index','create','store','edit','update');
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::middleware('autenticador:editor')->group(function () {
    Route::resource('/usuarios', UsersController::class)->only('create','store');
    Route::resource('/equipes', EquipesController::class)->except(['show']);
    Route::resource('/participantes', ParticipantesController::class)->except(['show']);
    Route::resource('campeonatos.times', TimesController::class)->only('edit','update','destroy','store');
});

Route::resource('/usuarios', UsersController::class)->only('index','edit','update','destroy')->middleware('autenticador:admin');