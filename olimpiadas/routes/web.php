<?php

use App\Http\Controllers\CampeonatosController;
use App\Http\Controllers\EquipesController;
use App\Http\Controllers\JogosController;
use App\Http\Controllers\ParticipantesController;
use App\Http\Controllers\TimesController;
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
    return view('components.index');
})->name('home.index');
Route::resource('/equipes', EquipesController::class)->except(['show']);
Route::resource('/participantes', ParticipantesController::class)->except(['show']);
Route::resource('/campeonatos', CampeonatosController::class)->only('index','create','store','destroy','show');
Route::resource('campeonatos.times', TimesController::class)->only('edit','update','destroy','store');
Route::resource('campeonatos.jogos', JogosController::class)->only('index','create','store','edit','update');