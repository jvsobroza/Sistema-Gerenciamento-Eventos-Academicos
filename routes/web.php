<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AtividadeController;
use \App\Http\Controllers\CertificadoController;
use \App\Http\Controllers\EventoController;
use \App\Http\Controllers\InscricaoController;
use \App\Http\Controllers\PresencaController;
use App\Http\Controllers\AuthController;

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
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', function () {
    return view('adm.dashboard');
})->middleware('auth')
    ->name('adm.dashboard');

Route::get('/aluno', function () {
    return view('aluno.paginaAluno');
})->middleware('auth')
    ->name('aluno.paginaAluno');

Route::resource('alunos', AtividadeController::class);
Route::resource('evento', EventoController::class);
Route::resource('insricao', InscricaoController::class);
Route::resource('presenca', PresencaController::class);
Route::resource('certificado', CertificadoController::class);



